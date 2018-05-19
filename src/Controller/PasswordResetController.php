<?php

namespace App\Controller;

use App\Form\Type\ResetPasswordType;
use App\Entity\Member;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class PasswordResetController extends Controller
{
    /**
     * @Route("/passwordReset", name="passwordReset")
     */
    public function index(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $form = $this->createForm(ResetPasswordType::class);

        $form -> handleRequest($request);

        $repository = $this->getDoctrine()->getRepository(Member::class);

        $member = $repository->findOneBy(['email' => $_GET['email']]);

        if ($form->isSubmitted() && $form->isValid()) {

            if($_GET['hash'] === $member->getRecoveryHash()){

                $info = $form->getData();

                $plainPassword = $info['plainPassword'];

                $encoded = $encoder->encodePassword($member, $plainPassword);

                $member->setPassword($encoded);
                $member->setRecoveryHash(null);

                $em = $this->getDoctrine()->getManager();

                $em->persist($member);
                $em->flush();

                $this->addFlash('success', 'Slaptazodis sekmingai pakeistas! Galite prisijungti.');

                return $this->redirectToRoute('login');
            }
            else $this->redirectToRoute('resetPassword');
        }

        return $this->render('password_reset/index.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
