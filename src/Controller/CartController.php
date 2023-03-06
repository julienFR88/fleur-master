<?php

namespace App\Controller;

use App\Services\AddtocartServices;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class CartController extends AbstractController
{

  private AddtocartServices $AddtocartServices;
  public function __construct(AddtocartServices $addtocartServices)
  {
    $this->AddtocartServices = $addtocartServices;
  }

  #[Route('/cart', name: 'app_cart')]
  public function index(): Response
  {
    $items = $this->AddtocartServices->getFullCart();

    $total = $this->AddtocartServices->getTotal();

    return $this->render('cart/cart.html.twig', [
      'items' => $items,
      'total' => $total, 
    ]);
  }
}