<?php


namespace App\Controller\Http;
use App\Repository\ProductRepository;
use App\Services\AddtocartServices;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ModalController extends AbstractController
{
  private AddtocartServices $AddtocartServices;

  public function __construct(AddtocartServices $AddtocartServices)
  {
    $this->AddtocartServices = $AddtocartServices;
  }


  #[Route('/ajax/addtocart', name: "app_modal_addtocart")]

  public function index(Request $request, ProductRepository $productRepository )
  {
    $id = $request->query->get('id');

    if ($request->isXmlHttpRequest() == true) {
      $ModalAddToCart = $productRepository->find($id);

      // A prevoir l'envoie en sessions pour notre panier
      $this->AddtocartServices->add($id);

      $donneesAEnvoyerALaModal = [
        'Image' => $ModalAddToCart->getPictures()->getValues()[0]->getimageName(),
        'Titre' => $ModalAddToCart->getTitle(),
        'Slug' => $ModalAddToCart->getSlug(),
      ];
      return new JsonResponse($donneesAEnvoyerALaModal);
    }

    
  }
}


