<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
  #[Route('/category/{slug}', name: 'app_category')]
  public function index($slug, CategoryRepository $categoryRepository, PaginatorInterface $paginator, Request $request): Response
  {

    $produit = $categoryRepository->PaginateCategory($slug);

    $query = $produit[0]->getProducts()->getValues();
    $pagination = $paginator->paginate(
      $query,
      $request->query->getInt('Page', 1),
      3
    );

    return $this->render('category/index.html.twig', [

    'produits' => $pagination,
      
    ]);
  }
}
