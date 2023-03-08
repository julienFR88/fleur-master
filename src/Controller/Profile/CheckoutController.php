<?php

namespace App\Controller\Profile;

use App\Entity\Cart;
use App\Entity\Order;
use App\Form\OrderType;
use App\Repository\OrderRepository;
use App\Repository\UserRepository;
use App\Services\AddtocartServices;
use App\Services\StripeServices;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Stripe\Stripe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class CheckoutController extends AbstractController
{

  private AddtocartServices $AddtocartServices;
  private StripeServices $StripeServices;

  public function __construct(AddtocartServices $AddtocartServices, StripeServices $StripeServices)
  {
    $this->AddtocartServices = $AddtocartServices;
    $this->StripeServices = $StripeServices;
  }

  #[Route('/profile/checkout', name: 'profile_checkout')]
  #[isGranted('ROLE_USER')]
  public function index(Request $request, EntityManagerInterface $em, UserRepository $user): Response
  {
    // creation du Formulaire
    $Order = new Order();
    $form = $this->createForm(OrderType::class, $Order);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $Order->setUtilisateur($user->find($this->getUser()->getId()));
      $em->persist($Order);
      $em->flush();

      return $this->redirectToRoute('profile_paiement');
    }

    return $this->render('profile/checkout/index', [
      'Order' => $form->createView(),
    ]);
  }

  #[Route('/profile/paiement', name: 'profile_paiement')]
  #[isGranted('ROLE_USER')]

  public function Paiement(Request $request): Response
  {
    //Je créer le BTN submit dans le formulaire de paiement
    //pour avoir du code différent et d'autres possibilité je fait le formulaire dans le controller
    //et non dans le repertoire form
    //PS : A EVITER DE FAIRE COMME CELA :
    $form = $this->createFormBuilder()
      ->add('button', SubmitType::class, [
        'attr' =>
        [
          'class' => 'btn theme-btn-1 btn-effect-1 text-uppercase'
        ]
      ])
      ->getForm();

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      // $success        = $this->generateUrl('success_url', [], UrlGeneratorInterface::ABSOLUTE_URL);
      $cancel         = $this->generateUrl('cancel_url', [], UrlGeneratorInterface::ABSOLUTE_URL);
      $ValidStripe    = $this->StripeServices->PaiementStripe($cancel, $this->AddtocartServices->getFullCart());
      return $this->redirect($ValidStripe->url, 303);
    }

    return $this->render('profile/checkout/paiement.html.twig', [
      $items = $this->AddtocartServices->getFullCart(),
      $total = $this->AddtocartServices->getTotal(),
      $form = $form->createview(),
    ]);
  }

  #[Route('/profile/success', name: 'success_url')]
  #[isGranted('ROLE_USER')]
  public function success_url(Request $request, OrderRepository $order, ManagerRegistry $em): Response
  {
    
    $session_id_stripe = $request->query->get('session_id');
    $stripe = new \Stripe\StripeClient('sk_test_51Mh9SbArgZcue3lGZySKqjTES99T5b20z8AdVYzetGI73EuAMSUj5OstoXCoBXyhVbIVHC4OCp0mNk1n7bVD93rF000LJR8EUK');

    $session = $stripe->checkout->sessions->retrieve($_GET['session_id']);
    $customer = $stripe->customers->retrieve($session->customer);

    $id_stripe = $customer->id;

    
    /*
        $StripeSK = $_ENV['SK_TEST'];

        $stripe = new \Stripe\StripeClient($StripeSK);

        dd($stripe);

        $session = $stripe->checkout->sessions->retrieve(
            $request->query->get('session_id'),
            []
        );
        */

    $UpdateOrder = $order->findOneBy(
      ['Utilisateur' => $this->getUser()->getId()],
      ['id' => 'DESC']
    );

    //dd($UpdateOrder);

    if (!$UpdateOrder) {
      throw $this->createNotFoundException('L\'utilisateur n\'existe pas');
    }
    $UpdateOrder->setToken($id_stripe);
    $UpdateOrder->setStatus(1); // 1 = payé
    $UpdateOrder->setTax(0.2); // 20% de taxe
    $UpdateOrder->setTotal($this->AddtocartServices->getTotal()); // total de la commande
    $UpdateOrder->setSubTotal($this->AddtocartServices->getTotal() / 1.2); // total de la commande - taxe

    $sessionCart = $this->AddtocartServices->getFullCart();

    foreach ($sessionCart as $carts) {
      $cart = new Cart();
      $cart->setTitle($carts['product']->getTitle());
      $cart->setPrice($carts['product']->getPrice());
      $cart->setQuantity($carts['quantity']);
      $cart->setSKU($carts['product']->getSKU());
      $cart->setDiscount($carts['product']->getDiscount());
      $cart->setOrders($UpdateOrder);
      $em->getManager()->persist($cart);
      // $em->getConnection()->beginTransaction();
    }

    try {
      // $em->getManager()->persist($order);
      $em->getManager()->flush();
    } catch (\Exception $e) {
      throw $e;
    }


    //$em = $this->getDoctrine()->getManager();
    //$em->persist($UpdateOrder);


    //dd($em->getManager());

    return $this->render('profile/checkout/paiement_success.html.twig', [
      'total' => $this->AddtocartServices->getTotal(),
    ]);
  }
}
