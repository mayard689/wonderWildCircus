<?php

namespace App\DataFixtures;

use App\Entity\Artist;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ArtistFixtures extends Fixture
{
    const ARTIST_NUMBER=20;

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        for($i=0; $i<self::ARTIST_NUMBER; $i++){

            $gender='female';
            $article=' la ';
            if ($i < self::ARTIST_NUMBER/2) {
                $gender='male';
                $article = ' le ';
            }

            $artist = new Artist();
            $artist->setTitle($faker->sentence);
            $artist->setStory($faker->text);
            $artist->setName($faker->firstName($gender) . $article . $faker->colorName);
            $artist->setAge($faker->randomNumber(2));
            $artist->setHeight($faker->randomFloat(2, 0.9, 3));
            $artist->setOrigin($faker->country);
            $artist->setParticularity($faker->sentence);
            $artist->setIncredible($faker->sentence);

            $this->addReference('artist_' .$i, $artist);
            $manager->persist($artist);
        }
        $manager->flush();
    }
}
