<?php
namespace App\Controller;
use App\Mailer\Mailer;
use App\Service\TranslationService;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

class ContactController extends AbstractController
{
    private TranslationService $translationService;

    public function __construct(TranslationService $translationService)
    {
        $this->translationService = $translationService;
    }

    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, Mailer $mailer): Response
    {
        if ($request->isMethod('POST')) {
            $name = $request->request->get('name');
            $email = $request->request->get('email');
            $subject = $request->request->get('subject');
            $message = $request->request->get('message');

            if ($name && $email && $subject && $message) {
                try {
                    $mailer->sendContactEmail('contact@alphorn-project.com', $name, $email, $subject, $message);
                    $this->addFlash('success', 'Votre message a été envoyé avec succès !');
                } catch (TransportExceptionInterface $e) {
                    $this->addFlash('error', 'Erreur lors de l\'envoi de votre message.');
                }
            } else {
                $this->addFlash('error', 'Tous les champs sont obligatoires.');
            }
        }

        return $this->render('page/contact.html.twig');
    }
}
