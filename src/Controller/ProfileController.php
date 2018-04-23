<?php

namespace App\Controller;

use App\Form\Type\MemberType;
use App\Entity\UserInfo;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class ProfileController extends Controller
{
    /**
     * @Route("/profile", name="profile")
     */
    public function ChangeProfileAction(Request $request)
    {
        $UserInfo = new UserInfo();

        $form = $this->createFormBuilder($UserInfo)

         ->add('firstName', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin bottom:15px')))
         ->add('lastName', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin bottom:15px')))
         ->add('bornAt', DateTimeType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin bottom:15px')))
         ->add('country', TextAreaType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin bottom:15px')))
            ->add('city', TextAreaType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin bottom:15px')))
            ->add('address', TextAreaType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin bottom:15px')))
            ->add('description', TextAreaType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin bottom:15px')))

        ->add('submit', SubmitType::class, array('label' => 'Update'))
         ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            die('submitted');
        }

        return $this->render('profile/profile.html.twig',
            array('form' => $form->createView()));


    }
}

