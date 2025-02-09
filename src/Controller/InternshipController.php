<?php

namespace App\Controller;

use App\Entity\Internship;
use App\Repository\InternshipRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class InternshipController extends AbstractController
{
    #[Route('/stage', name: 'app_internship')]
    public function index(InternshipRepository $internshipRepository): Response
    {
        $internships = $internshipRepository->findAll();

        return $this->render('page/internship.html.twig', [
            'internships' => $internships,
        ]);
    }
}
