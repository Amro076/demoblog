<?php

namespace App\Controller;

use App\Entity\Page;
use App\Repository\PageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MonController extends AbstractController
{
    #[Route('/mon', name: 'app_mon')]
    public function index(PageRepository $repo): Response
    {
        $pages =$repo->findAll();
        return $this->render('mon/index.html.twig', [
            'pages' => $pages,
        ]);
    }

    #[Route("/page", name:"page")]
    public function page()
    {
        return $this->render('mon/page.html.twig',[
            'title'=>'Bienvenue',
            'age'=>42

        ]);
    }

    #[Route ("/sous_article/{id}", name:'sous_article')]
    public function sous($id, PageRepository $repo)
    {
        $page = $repo->find($id);
        return $this->render('mon/sous_article.html.twig', [
            'page' => $page
        ] 
        );
    }
}
