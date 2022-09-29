<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BlogController extends AbstractController
{
    #[Route('/', name:'home')]
    public function home()
    {
        return $this->render('blog/home.html.twig', [
            'slogan' => "La démo d'un blog", 'age' => 28
        ]);
        //pour envoyer de variable depuis le controller, la méthode render prend en 2éme arg un tableau associatife
    }


    #[Route('/blog', name: 'app_blog')]
    public function index(ArticleRepository $repo): Response
    {
        // pour récuperer la repository, je le passe en arg de la méthode index()
        //cela s'appelle une injection de dépendance
        $articles = $repo->findAll();
        //j'utilise findAll() pour recuperer tous les articles en BDD


        return $this->render('blog/index.html.twig', [
            'articles' => $articles // j'envoie les articles
        ]);
    }

    #[Route('/blog/show/{id}', name:'blog_show')]
    public function show($id, ArticleRepository $repo) //$id correspond au {id} dans l'URL
    {
        $article = $repo->find($id);
        //find()permet de recuperer un article en fonction de son id
        return $this->render('blog/show.html.twig', [
            'item'=> $article
        ]);
        
    }
    #[Route('/blog/new', name:"blog_create")]
    #[Route("/blog/edit/{id}", name:"blog_edit")]
    public function form(Request $globals, EntityManagerInterface $manager, Article $article = null)
    {
        //la classe Request contient les données véhiculées par les superglobales ($_POST, $8GET, $_SERVER...)
        if($article == null)
        {

        $article = new Article; //je crée un objet de la class Article vide prêt à être rempli
        $article->setCreatedAt(new \DateTime); //pour ajouter la date de creation seulement à l'insertion d'un article

        //si $article est null, nous somme dans la route blog_create : nous devons crée un nouvel article
        // sinon $article n'est pas null, nous sommes dans la route blog_edit : nous réqupérons l'article correspondant à l'id
        }
        $form = $this->createForm(ArticleType::class, $article); //importer ArticleType , je lie le formulaire à mon objet $article       
        //createForm( permet de récupérer un formulaire)

        $form->handleRequest($globals);

        //dump($globals); // permet d'afficher les donnée de l'objet $global(come var_dump())
        dump($article);

        if($form->isSubmitted() && $form->isValid())
        {
            
            $manager->persist($article); //prépare la reqûte d'insertion
            $manager->flush(); //exécute la reqûte d'insertion

            return $this->redirectToRoute('blog_show', [
                'id' => $article->getId()
            ]);
            //cette méthode permet de nous rediriger vers la page de notre article nouvellement crée
        }

        return $this->renderForm('blog/form.html.twig', [
            'formArticle' => $form,
            'editMode' => $article->getId() !== null
            // si nous sommes sur la route/new :editMode = 0
        ]); 
    }
    #[Route('/blog/delete/{id}', name:"blog_delete")]
        public function delete($id,EntityManagerInterface $manager, ArticleRepository $repo)
        {
            $article = $repo->find($id);

            $manager->remove($article); //préparé
            $manager->flush(); // exécuter
            
            return $this->redirectToRoute('app_blog'); //redirection
        }
}
