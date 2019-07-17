<?php


namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ContactController extends AbstractController
{
    /**
     *
     * @Route("/contact", name="app_contact")
     */
    public function index(Request $request, ObjectManager $manager):Response
    {
        $contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($contact);
            $manager->flush();

            $this->addFlash('success', 'Votre message a bien été envoyé.');
        }

        return $this->render('layout/contact.html.twig', ['contactForm' => $form->createView()]);
    }
}