<?php

namespace App\DataFixtures;

use App\Entity\Ad;
use App\Entity\Image;
use Faker\Factory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('FR-fr');

        for ($i = 1; $i <= 30; $i++) {
            $ad = new Ad();
            $title        = $faker->sentence();
            $coverImage   = $faker->imageUrl(1000, 350);
            $introduction = $faker->paragraph(2);
            $content      = '<p>' . join('</p><p>', $faker->paragraphs(5)) . '</p>';

            $ad->setTitle("$title")
                ->setCoverImage($coverImage)
                ->setIntroduction($introduction)
                ->setContent($content)
                ->setPrice(mt_rand(50, 300))
                ->setRooms(mt_rand(1, 5));

            for ($j = 1; $j < mt_rand(2, 5); $j++) {

                $image = new Image();
                $image->setUrl($faker->imageUrl())
                    ->setCaption($faker->sentence())
                    ->setAd($ad);
                $manager->persist($image);
            }

            $manager->persist($ad);
        }

        $manager->flush();
    }
}
