<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\TranslationService;
use App\Repository\NewsRepository;

class HomeController extends AbstractController
{
    private $translationService;
    private $newsRepository;

    public function __construct(TranslationService $translationService, NewsRepository $newsRepository)
    {
        $this->translationService = $translationService;
        $this->newsRepository = $newsRepository;
    }

    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        $news = $this->newsRepository->findAll();
        return $this->render('page/index.html.twig', [
            'news' => $news,
        ]);
    }
}
?>
