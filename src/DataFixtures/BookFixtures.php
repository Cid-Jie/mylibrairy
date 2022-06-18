<?php

namespace App\DataFixtures;

use App\Entity\Book;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BookFixtures extends Fixture
{
    public const BOOKS = [
        [  
            'title' => 'Toto à la plage', 
            'description' => 'C\'est toto qui va à la plage !', 
            'nbPages' => 12,
            'author' => 1,
        ],
        [  
            'title' => 'Dune', 
            'description' => 'Une vague histoire d\'épicerie.', 
            'nbPages' => 698,
            'author' => 2,
        ],
        [  
            'title' => 'L\'empereur-dieu de dune', 
            'description' => 'Toujours l\'épicerie, mais le tenancier a pris du grade', 
            'nbPages' => 322,
            'author' => 2,
        ],
        [  
            'title' => 'Le comte de Monte-Cristo', 
            'description' => 'De prisonnier à mieux qu\'un youtubeur.', 
            'nbPages' => 850,
            'author' => 4,
        ],
        [  
            'title' => 'Les misérables', 
            'description' => 'Une bande de looser.', 
            'nbPages' => 728,
            'author' => 5,
        ],
        [  
            'title' => 'Jurassic Park', 
            'description' => 'Un parc à theme presque vegan...', 
            'nbPages' => 412,
            'author' => 6,
        ],
    ];

    public function load(ObjectManager $manager): void
    {

        $i = 1;
        foreach(self::BOOKS as $dataBook) {
            $book = new Book();
            $book
                ->setTitle($dataBook['title'])
                ->setDescription($dataBook['description'])
                ->setNbOfPages($dataBook['nbPages'])
                ->setAuthor($this->getReference('author_' . $dataBook['author']))
            ;

            $manager->persist($book);
            $this->addReference('book_' . $i, $book);
            $i++;
        }

        $manager->flush();
    }
}

