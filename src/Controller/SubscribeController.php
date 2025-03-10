<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SubscribeController extends AbstractController
{
    #[Route('/abonnements', name: 'app_subscribe')]
    public function index(): Response
    {
        return $this->render('page/subscribe.html.twig', []);
    }
}
