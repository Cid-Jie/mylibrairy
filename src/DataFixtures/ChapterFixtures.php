<?php

namespace App\DataFixtures;

use App\Entity\Chapter;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ChapterFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        $nbOfBooks = count(BookFixtures::BOOKS);

        for($i = 1; $i <= $nbOfBooks; $i++) {
            $book = $this->getReference('book_' . $i);

            for($j = 0; $j < rand(5, 10); $j++) {
                $chapter = new Chapter();
                $chapter
                        ->setNumber($j + 1)
                        ->setDescription($faker->paragraph(2))
                        ->setBook($book)
                ;
                $manager->persist($chapter);
            }
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            BookFixtures::class
        ];
    }
}