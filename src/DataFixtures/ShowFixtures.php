<?php

namespace App\DataFixtures;

use App\Entity\Show;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ShowFixtures extends Fixture
{
    const SHOW_NUMBER=20;

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        for($i=0; $i<self::SHOW_NUMBER; $i++){
            $city=$this->faker->city;

            $show = new Show();
            $show->setDate(new DateTime($faker->date()));
            $show->setCity($city);
            $show->setQuantity($faker->randomNumber(2));

            $this->addReference('show_' .$i, $show);
            $manager->persist($show);
        }
        $manager->flush();

    }

    /**
     * @inheritDoc
     */
    public function getDependencies()
    {
        return [CategoryFixtures::class];
    }
}
