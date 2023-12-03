<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ContactRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(ContactRepository $contact, Request $request): Response
    {
        $value = $request->query->get('search');
        if (null == $value) {
            $value = '';
        }
        $res = $contact->search($value);

        return $this->render('contact/index.html.twig', ['contacts' => $res, 'search' => $value]);
    }

    #[Route('/contact/{id}', name: 'app_contact_show', requirements: ['id' => '\d+'])]
    public function show(
        #[MapEntity(expr: 'repository.findWithCategory(id)')]
        Contact $contact): Response
    {
        return $this->render('contact/show.html.twig', ['contact' => $contact]);
    }

    #[Route('/contact/{id}/update', name: 'app_contact_update', requirements: ['id' => '\d+'])]
    public function update(
        #[MapEntity(expr: 'repository.findWithCategory(id)')]
        Contact $contact,
        Request $request,
        EntityManagerInterface $entityManager)
    {
        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();
            $entityManager->flush();

            return $this->redirectToRoute('app_contact_show', [
                'id' => $contact->getId()
            ]);
        }

        return $this->render('contact/update.html.twig', ['contact' => $contact, 'form' => $form]);
    }

    #[Route('/contact/create', name: 'app_contact_create', requirements: ['id' => '\d+'])]
    public function create()
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);

        return $this->render('contact/create.html.twig', ['form' => $form]);
    }

    #[Route('/contact/{id}/delete', name: 'app_contact_delete', requirements: ['id' => '\d+'])]
    public function delete(
        #[MapEntity(expr: 'repository.findWithCategory(id)')]
        Contact $contact)
    {
        $form = $this->createForm(ContactType::class, $contact);

        return $this->render('contact/delete.html.twig', ['contact' => $contact, 'form' => $form]);
    }
}
