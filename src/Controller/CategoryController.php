<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Repository\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    #[Route('/category', name: 'app_category')]
    public function index(CategoryRepository $repository): Response
    {
        $catg = $repository->findAllAlphabeticallyWithContactCount();

        dump($catg);

        return $this->render('category/index.html.twig', [
            'catgs' => $catg,
        ]);
    }

    #[Route('/category/{id}', name: 'app_category_show', requirements: ['id' => '\d+'])]
    public function show(Category $category, ContactRepository $contactRepository): Response
    {
        $contacts = $contactRepository->findBy(['category' => $category->getId()], ['lastname' => 'ASC', 'firstname' => 'ASC']);

        return $this->render('category/show.html.twig', ['catg' => $category, 'contacts' => $contacts,
        ]);
    }
}
