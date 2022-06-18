<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\BookType;
use App\Repository\AuthorRepository;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    #[Route('/', name: 'app_book')]
    public function index(BookRepository $bookRepository): Response
    {
        $books = $bookRepository->findAll();
        return $this->render('book/index.html.twig', [
            'books' => $books,
        ]);
    }

    #[Route('/book/add', name: 'app_book_add')]
    public function add(BookRepository $bookRepository, Request $request) 
    {
        $book = new Book();
        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $bookRepository->add($book, true);

            return $this->redirectToRoute('app_book');
        }

        return $this->renderForm('book/add.html.twig', ['form' => $form]);
    }

    #[Route('/book/{id}', name: 'app_book_details')]
    public function details(Book $book) 
    {

        return $this->render('book/details.html.twig', [
            'book' => $book, 
        ]);
    }

    #[Route('/book/author/{lastname}', name: 'app_book_author_list')]
    public function authorList(string $lastname, AuthorRepository $authorRepository, BookRepository $bookRepository) {

        $author = $authorRepository->findOneBy(['lastname' => $lastname]);
        $books = $bookRepository->findBy(['author' => $author]);

        return $this->render('book/index.html.twig', ['books' => $books]);
    }
}
