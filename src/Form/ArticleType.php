<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Category;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // l'ojet $builder permet de crée un formulaire
        // la méthode add() permet d'ajouter un champ au formulaire
        $builder
            ->add('title')
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'title'
            ])
            ->add('content', TextType::class, [
               'attr' => [
                'placeholder' => "contenu de l'article",//ici on ajout un attribut (placeholder) au champ
                'style' => "border-radius: 5px",
                'class' => "form-control"
               ] 
            ]
            ) // je modifie le champ content en tant qu'input text
            ->add('image')
           // ->add('createdAT')
           // nous comentant ce champ car la date d'ajout sera ajoutée automatiquement lors de l'insertion de l'article
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
