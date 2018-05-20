<?php

namespace App\Controller;

use App\Form\Type\MemberType;
use App\Entity\Member;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class RegistrationController extends Controller
{
    /**
     * @Route("/register", name="registration")
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \LogicException
     */
    public function registerAction(Request $request, \Swift_Mailer $mailer)
    {
        $member = new Member();

        $form = $this->createForm(MemberType::class, $member, [
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $password = $this
                ->get('security.password_encoder')
                ->encodePassword(
                    $member,
                    $member->getPlainPassword()
                );

            $member->setPassword($password);
            $member->setRoles(['ROLE_USER']);

            $em = $this->getDoctrine()->getManager();

            $em->persist($member);
            $em->flush();

            $token = new UsernamePasswordToken(
                $member,
                $password,
                'main',
                $member->getRoles()
            );

            $this->get('security.token_storage')->setToken($token);
            $this->get('session')->set('_security_main', serialize($token));

            $this->addFlash('success', 'Sveikiname prisiregistravus!');

            $this->redirectToRoute('homepage');

            $message = (new \Swift_Message('Škiperis jus sveikina!'))
                ->setFrom('skiperispingvinauskas@gmail.com')
                ->setTo($member->getEmail())
                ->setBody(
                    $this->renderView(
                        'email/registrationEmail.html.twig',
                        array('name' => $member->getUsername())
                    ),
                    'text/html'
                );

            $mailer->send($message);
        }


        return $this->render('registration/register.html.twig', [
            'registration_form' => $form->createView(),
        ]);
    }
}