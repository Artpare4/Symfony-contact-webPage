<?php

namespace App\Controller;

use App\Repository\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(ContactRepository $contact): Response
    {
        $res = $contact->findBy(['firstname' => 'ASC', 'lastname' => 'ASC']);

        return $this->render('contact/index.html.twig', ['contact' => $res]);
    }
}
