<?php

namespace App\Controller;

use App\Repository\AccessoriesRepository;
use App\Service\TranslationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AccessoriesController extends AbstractController
{
    private $translationService;

    public function __construct(TranslationService $translationService)
    {
        $this->translationService = $translationService;
    }

    #[Route('/accessoires', name: 'app_accessories')]
    public function index(AccessoriesRepository $accessoriesRepository): Response
    {
        $accessories = $accessoriesRepository->findAll();

        return $this->render('page/accessories.html.twig', [
            'accessories' => $accessories,
        ]);
    }
}
