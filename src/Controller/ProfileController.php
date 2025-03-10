<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ProfileFormType;
use App\Repository\CourseRepository;
use App\Repository\TestimonialRepository;
use App\Service\TranslationService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
class ProfileController extends AbstractController
{
    private $translationService;

    public function __construct(TranslationService $translationService)
    {
        $this->translationService = $translationService;
    }

    #[Route('/profile', name: 'app_profile')]
    public function index(
        Request $request,
        EntityManagerInterface $entityManager,
        TestimonialRepository $testimonialRepository,
        CourseRepository $courseRepository
    ): Response {
        /** @var User $user */
        $user = $this->getUser();

        $profileForm = $this->createForm(ProfileFormType::class, $user);
        $profileForm->handleRequest($request);

        if ($profileForm->isSubmitted() && $profileForm->isValid()) {
            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash('success', 'Les informations de votre profil ont été mises à jour.');
            return $this->redirectToRoute('app_profile');
        }

        $testimonials = $testimonialRepository->findBy(['fk_id_user' => $user->getId()]);
        $courses = $courseRepository->findCoursesByUser($user);

        return $this->render('page/profile.html.twig', [
            'profileForm' => $profileForm->createView(),
            'testimonials' => $testimonials,
            'courses' => $courses,
            'user' => $user,
        ]);
    }
}
