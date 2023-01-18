<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Personne;
class PersonneFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // use the factory to create a Faker\Generator instance
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 10; $i++) {
            $personne = new Personne();
            $personne->setFirstname($faker->firstName);
            $personne->setName($faker->name);
            $personne->setAge($faker->numberBetween(18, 65));
    
            $manager->persist($personne);
            
        }
        $manager->flush();
    }
}
