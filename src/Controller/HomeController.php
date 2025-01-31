<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\TranslationService;

class HomeController extends AbstractController
{
    private $translationService;

    public function __construct(TranslationService $translationService)
    {
        $this->translationService = $translationService;
    }

    #[Route('/', name: 'app_home')]
   public function index(): Response
    {
        return $this->render('page/index.html.twig');
    }
}
?>
