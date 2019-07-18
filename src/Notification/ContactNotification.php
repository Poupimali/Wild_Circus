<?php


namespace App\Notification;

use App\Entity\Contact;
use Twig\Environment;

class ContactNotification
{
    private $mailer;
    private $renderer;

    public function __construct(\Swift_Mailer $mailer, Environment $renderer){
        $this->mailer = $mailer;
        $this->renderer = $renderer;

    }

    public function notify(Contact $contact){
        $message = (new \Swift_Message( 'Email Wild Circus : ' . $contact->getObject()))
            ->setFrom($contact->getEmail())
            ->setTo('poupimali@gmail.com')
            ->setReplyTo($contact->getEmail())
            ->setBody($this->renderer->render('layout/email.html.twig', [
                'contact' => $contact
            ]), 'text/html');
        $this->mailer->send($message);
    }
}