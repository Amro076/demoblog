<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Voiture;

class VoitureFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i = 1; $i <= 15; $i++){

            $voiture = new Voiture;
            $voiture->setMarque("marque $i")
                    ->setModele("<p>modele $i</p>")
                    ->setPrix($i * 3.7)
                    ->setDescription("petit voiture $i");

                   

        $manager->persist($voiture);
        //persist()permet de faire persister l'article dans le temps et préparer son insertion en BDD 

        
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
