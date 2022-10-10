<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;

class ArticleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('title', 'titre'),
            TextField::new('image'),
            TextareaField::new('content', 'contenu')->setMaxLength(20)->hideOnForm(),
            DateTimeField::new('createdAt')->setFormat("d/M/Y à H:m:s")->hideOnForm(),
            AssociationField::new('category'),
            TextEditorField::new('content')->onlyOnForms(),

           
        ];
    }

    public function createEntity(string $entityFqcn)
    {
        // creatEntity( est exécutée lorsque je clique sur 'add article)
        // elle permet d'exécuter du code avant l'affichage de la page
        //ics je vais définir une date de création
        $article =new $entityFqcn; // ici , équivaut à $article
        $article->setCreatedAt(new \DateTime);
        return $article;
    }
   
}
