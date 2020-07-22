<?php

namespace App\DataFixtures;

use App\Entity\Show;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ShowFixtures extends Fixture
{
    const SHOW_NUMBER=30;

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        for($i=0; $i<self::SHOW_NUMBER; $i++){
            $city=$faker->city;

            $show = new Show();
            $show->setDate($faker->dateTimeBetween('-1 years', '2021/12/31'));
            $show->setCity($city);
            $show->setQuantity($faker->randomNumber(2));

            $this->addReference('show_' .$i, $show);
            $manager->persist($show);
        }
        $manager->flush();

    }
}
