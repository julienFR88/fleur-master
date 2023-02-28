<?php


namespace App\Services;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class AddtocartServices
{

  private RequestStack $requestStack;

  public function __construct(RequestStack $requestStack)
  {
    $this->requestStack = $requestStack;
  }

  public function add(int $id)
  {
    $cart = $this->requestStack->getSession()->get('cart', []);
    if (!empty($cart[$id])) {
      $cart[$id]++;
    } else {
      $cart[$id] = 1;
    }
    $this->getSession()->set('cart', $cart);

    //  pensez a mettre en Bdd Le panier de l'utilisateur
  }

  private function getSession(): SessionInterface
  {
    return $this->requestStack->getSession();
  }
}



