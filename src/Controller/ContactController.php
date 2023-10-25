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
        $res = $contact->findBy([], ['lastname' => 'ASC', 'firstname' => 'ASC']);

        return $this->render('contact/index.html.twig', ['contacts' => $res]);
    }

    #[Route('/contact/{contactId}', requirements: ['contactId' => '\d+'])]
    public function show(int $contactId)
    {
    }
}
