<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HybridHornController extends AbstractController
{
    #[Route('/cor-hybrid', name: 'app_hybrid_horn')]
    public function index(): Response
    {
        return $this->render('page/hybrid_horn.html.twig', [
            'controller_name' => 'HybridHornController',
        ]);
    }
}
