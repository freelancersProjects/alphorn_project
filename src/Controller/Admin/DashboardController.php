<?php

namespace App\Controller\Admin;

use App\Entity\Accessories;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\News;
use App\Entity\User;
use App\Entity\Contact;
use App\Entity\Internship;
use App\Entity\Translation;
use App\Entity\Course;
use App\Entity\CourseBlock;
use App\Entity\Testimonial;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ADMIN')]
class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Alphorn Project');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::section('Utilisateurs');
        yield MenuItem::linkToCrud('Les utilisateurs', 'fas fa-users', User::class);
        yield MenuItem::linkToCrud('Contact', 'fas fa-envelope', Contact::class);

        yield MenuItem::section('Cours');
        yield MenuItem::linkToCrud('Cours', 'fas fa-book', Course::class);
        yield MenuItem::linkToCrud('Structure Cours', 'fas fa-swatchbook', CourseBlock::class);

        yield MenuItem::section('Contenu intéractif');
        yield MenuItem::linkToCrud('Les actualités', 'fas fa-newspaper', News::class);
        yield MenuItem::linkToCrud('Les témoignages', 'fas fa-comments', Testimonial::class);
        yield MenuItem::linkToCrud('Les stages', 'fas fa-briefcase', Internship::class);
        yield MenuItem::linkToCrud('Les accessoires', 'fas fa-music', Accessories::class);

        yield MenuItem::section('Traductions');
        yield MenuItem::linkToCrud('Les traductions', 'fas fa-language', Translation::class);
    }
}
