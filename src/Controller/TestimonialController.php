<?php

namespace App\Controller;

use App\Entity\Testimonial;
use App\Form\TestimonialFormType;
use App\Repository\TestimonialRepository;
use App\Service\TranslationService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class TestimonialController extends AbstractController
{
    private TranslationService $translationService;

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

    #[Route('/temoignages/ajouter', name: 'app_add_testimonial')]
    public function addTestimonial(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $testimonial = new Testimonial();
        $form = $this->createForm(TestimonialFormType::class, $testimonial);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $mainImage = $form->get('main_image')->getData();

            if ($mainImage) {
                $originalFilename = pathinfo($mainImage->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $mainImage->guessExtension();

                try {
                    $mainImage->move(
                        $this->getParameter('testimonial_images_directory'),
                        $newFilename
                    );
                    $testimonial->setMainImage($newFilename);
                } catch (FileException $e) {
                    $this->addFlash('danger', 'Erreur lors de l\'upload de l\'image.');
                }
            }

            $testimonial->setDate(new \DateTime());
            $testimonial->setFkIdUser($this->getUser());

            $entityManager->persist($testimonial);
            $entityManager->flush();

            $this->addFlash('success', $this->translationService->translate('testimonial_add_success', $request->getLocale()));

            return $this->redirectToRoute('app_testimonial');
        }

        return $this->render('page/add_testimonial.html.twig', [
            'testimonialForm' => $form->createView(),
        ]);
    }
}
