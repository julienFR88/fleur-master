<?php

namespace App\Controller\Profile;

use Stripe\Stripe;
use App\Entity\Order;
use App\Form\OrderType;
use App\Services\StripeServices;
use App\Repository\UserRepository;
use App\Repository\OrderRepository;
use App\Services\AddtocartServices;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
      $success        = $this->generateUrl('success_url', [], UrlGeneratorInterface::ABSOLUTE_URL);
      $cancel         = $this->generateUrl('cancel_url', [], UrlGeneratorInterface::ABSOLUTE_URL);
      $ValidStripe    = $this->StripeServices->PaiementStripe($success, $cancel, $this->AddtocartServices->getFullCart());
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
  public function success_url(Request $request, OrderRepository $Order): Response
  {
    $UpdateOrder = $order->findOneBy(['Utilisateur' => $this->getUser()->getId()], ['id' => 'DESC']);

    if (!UdateOrder) {
      throw $this->createdNotFoundException('L\'utilisateur est inexistant');
    }

    $UpdateOrder->setStatus(1); // 1 = payé
    $UpdateOrder->setTax('0.2'); // 0.2 = pourcentage de tax
    $UpdateOrder->setTotal($this->AddtocartServices->getTotal()); // affiche le montant avec les taxes
    $UpdateOrder->setSubTotal($this->AddtocartServices->getTotal() / 1.2); // affiche le montant HT
    $em->getManager->flush();

    return $this->render('profil/checkout/paiement_success.html.twig', [
      'total' => $this->AddtocartServices-getTotal()
    ]);
  }

  #[Route('/profile/cancel', name: 'cancel_url')]
  #[isGranted('ROLE_USER')]
  public function cancel_url(): Response
  {
    return $this->render('profil/checkout/paiement_cancel.html.twig');
  }
}
