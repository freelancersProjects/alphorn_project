<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\CourseRepository;
use App\Service\TranslationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChangePassword extends AbstractController
{
    private $translationService;

    public function __construct(TranslationService $translationService)
    {
        $this->translationService = $translationService;
    }

    #[Route('/modification-mot-de-passe', name: 'app_change_password')]
    public function changePassword(): Response
    {
        $user = $this->getUser();

        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        return $this->render('page/change-password.html.twig', [
            'user' => $user,
        ]);
    }
}
