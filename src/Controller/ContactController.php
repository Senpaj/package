<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Form\Type\ContactFormType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;

use App\Entity\Contact;
use App\Entity\Member;


class ContactController extends Controller
{
    /**
     * @Route("/contact", name="contact")
     */
    public function createAction(Request $request, \Swift_Mailer $mailer)
    {
        $contact = new Contact;
        # Add form fields
        $form = $this->createForm(ContactFormType::class);

        # Handle form response
        $form->handleRequest($request);
        #check if form is submitted

        if ($form->isSubmitted() && $form->isValid()) {
            $name = $form['name']->getData();
            $email = $form['email']->getData();
            $subject = $form['subject']->getData();
            $message = $form['message']->getData();

            # set form data

            $contact->setName($name);
            $contact->setEmail($email);
            $contact->setSubject($subject);
            $contact->setMessage($message);

            # finally add data in database

            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();

            $message = (new \Swift_Message('Skiperis jus sveikina!'))
                ->setSubject($subject)
                ->setFrom('skiperispingvinauskas@gmail.com')
                ->setTo($email)
                ->setBody($this->renderView('email/contactMessage.html.twig', array('name' => $name)), 'text/html');

            $mailer->send($message);

        }
        return $this->render('contact/index.html.twig',
            array(
                'form' => $form->createView()));

    }
}
