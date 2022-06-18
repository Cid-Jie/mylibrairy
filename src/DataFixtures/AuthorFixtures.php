<?php

namespace App\DataFixtures;

use App\Entity\Author;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AuthorFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $authors = [
            ['Thomas', 'Aldaitz', 37],
            ['Frank', 'Herbert', 0],
            ['Haruki', 'Murakami', 0],
            ['Alexandre', 'Dumas', 0],
            ['Victor', 'Hugo', 0],
            ['Michael', 'Crichton ', 0],
        ];

        $i = 1;
        foreach($authors as $dataAuthor) {
            $author = new Author();
            $author
                ->setLastname($dataAuthor[1])
                ->setFirstname($dataAuthor[0])
                ->setAge($dataAuthor[2])
                ;

            $manager->persist($author);
            $this->addReference('author_' . $i++, $author);
        }

        $manager->flush();  
    }
}
