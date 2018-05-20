<?php

namespace App\Controller;

use App\Form\Type\PasswordFormType;
use App\Entity\UserInfo;
use Symfony\Component\BrowserKit\Response;
use App\Entity\Member;
use App\Entity\CustomerOrder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class ChangePasswordController extends Controller
{
    /**
     *
     * @Route("/changePassword", name="changePassword")
     *
     */
    public function changePasswordAction(Request $request)
    {
        $user = $this->getUser();
        $form = $this->createForm(PasswordFormType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $passwordNew = $this
                ->get('security.password_encoder')
                ->encodePassword(
                    $user,
                    $form->get('plainPasswordNew')->getData());

            $user->setPassword($passwordNew);

            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('homepage', array(
                'success' => "Slaptažodis pakeistas."
            ));
        }
        return $this->render('changePassword/changePassword.html.twig', [
            'changePassword_form' => $form->createView()]);
    }
}


