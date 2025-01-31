<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\News;
use App\Entity\User;
use App\Entity\Contact;
use App\Entity\Internship;
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

        yield MenuItem::section('Actualités/Témoignages');
        yield MenuItem::linkToCrud('Les actualités', 'fas fa-newspaper', News::class);
        yield MenuItem::linkToCrud('Les témoignages', 'fas fa-comments', Internship::class);
    }
}
