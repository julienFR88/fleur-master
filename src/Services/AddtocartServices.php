<?php

namespace App\Services;


use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class AddtocartServices
{
  private RequestStack $requestStack;
  private EntityManagerInterface $em;

  public function __construct(RequestStack $requestStack, EntityManagerInterface $em)
  {
    $this->requestStack = $requestStack;
    $this->em = $em;
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

    //penser a mettre en base de donnée le panier de l'utilisateur
  }

  public function getFullCart(): array
  {
    $cart     = $this->getSession()->get('cart', []);
    $cartData = [];

    if ($cart) {
      foreach ($cart as $id => $quantity) {
        $product = $this->em->getRepository(Product::class)->findOneBy(['id' => $id]);
        if (!$product) {
          // condition en cas d'erreur
          // par exemple, le produit n'existe pas
          // produit n est plus en stock dans les secondes qui suivent l'ajout au panier
          // etc.
        }

        $cartData[] = [
          'product'  => $product,
          'quantity' => $quantity,
        ];
      }
    }
    return $cartData;
  }


  public function getTotal(): float
  {
    $total = 0;

    foreach ($this->getFullCart() as $item) {
      // prevoir les promotions
      
      $total += $item['product']->getPrice() * $item['quantity'];
    }
    return $total;
  }

  
  public function remove(int $id) 
  {
    $cart = $this->getSession()->get('cart', []);

    if (!empty($cart[$id])) {
      if ($cart[$id] > 1) {
        $cart[$id]--;
      } else {
        unset($cart[$id]);
      }
    }
    $this->getSession()->set('cart', $cart);
  }

  private function getSession(): SessionInterface
  {
    return $this->requestStack->getSession();
  }
}