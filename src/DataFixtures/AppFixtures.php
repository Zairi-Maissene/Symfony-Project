<?php

namespace App\DataFixtures;

use App\Entity\Entreprise;
use App\Entity\PFE;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        for ($i = 0; $i < 10; $i++) {
            $pfe = new PFE();
            $pfe->setStudent($faker->name);
            $pfe->setTitle($faker->word);
            $entreprise = new Entreprise();
            $entreprise->setDesignation($faker->word);
            $manager->persist($pfe);
            $manager->persist($entreprise);
        }


        $manager->flush();
    }
}
