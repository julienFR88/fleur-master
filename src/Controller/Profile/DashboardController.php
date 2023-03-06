<?php

namespace App\Controller\Profile;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
  #[Route('/profile/dashboard', name: 'profile_dashboard')]
  #[isGranted('ROLE_USER')]
  public function index(): Response
  {
    return $this->render('profile/dashboard/index.html.twig', [
      'controller_name' => 'DashboardController',
    ]);
  }
}