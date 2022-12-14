<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Article;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('<b>BACKOFFICE DEMOBLOG</b>');
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linkToDashboard('Accueil', 'fa fa-home'), //génère un lien vers ce dashboard
            MenuItem::section('Blog'), //on crée une section pour catégoriser les items du menu appeler (Blog)
            MenuItem::linkToCrud('Articles', 'fas fa-newspaper', Article::class), //Génère un lien 
            MenuItem::section('Membres'),
            MenuItem::linkToCrud('Utilisateurs', 'fas fa-user', User::class),
        ];
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
