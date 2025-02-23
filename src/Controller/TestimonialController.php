<?php

namespace App\Controller;

use App\Repository\TestimonialRepository;
use App\Service\TranslationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TestimonialController extends AbstractController
{
    private $translationService;

    public function __construct(TranslationService $translationService)
    {
        $this->translationService = $translationService;
    }

    #[Route('/temoignages', name: 'app_testimonial')]
    public function index(TestimonialRepository $testimonialRepository): Response
    {
        $testimonials = $testimonialRepository->findAll();

        return $this->render('page/testimonial.html.twig', [
            'testimonials' => $testimonials,
        ]);
    }
}
