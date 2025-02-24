<?php

namespace App\Controller;

use App\Repository\NewsRepository;
use App\Service\TranslationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class NewsController extends AbstractController
{
    private $translationService;

    public function __construct(TranslationService $translationService)
    {
        $this->translationService = $translationService;
    }

    #[Route('/actualites', name: 'app_news')]
    public function index(NewsRepository $newsRepository): Response
    {
        $news = $newsRepository->findAll();

        return $this->render('page/news.html.twig', [
            'news' => $news,
        ]);
    }
}
