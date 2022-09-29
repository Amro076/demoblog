<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Page;

class PageFixtures extends Fixture
{
    
    public function load(ObjectManager $manager): void
    {
        for($i = 1; $i <= 10; $i++)
    {

        $page = new Page;
        $page->setTitre("titre de ma page $i")
            ->setContenu("<p>contenu de ma page $i</p>");

         $manager->persist($page);
    }
        $manager->flush();
    }
}
