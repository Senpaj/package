<?php

namespace App\Controller;

use App\Form\Type\MemberType;
use App\Entity\UserInfo;
use App\Entity\Member;
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
     * @Route("/profile/profileCreate/{id}", name="profileCreate")
     */
    public function CreateProfileAction(Request $request)
    {

        $userInfo = new UserInfo();
        $member = $this->getUser();

        $form = $this->createFormBuilder($userInfo)

         ->add('firstName', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin bottom:15px')))
         ->add('lastName', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin bottom:15px')))
         ->add('bornAt', DateTimeType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin bottom:15px')))
         ->add('country', TextAreaType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin bottom:15px')))
            ->add('city', TextAreaType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin bottom:15px')))
            ->add('address', TextAreaType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin bottom:15px')))
            ->add('description', TextAreaType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin bottom:15px')))
        ->add('submit', SubmitType::class, array('label' => 'Create'))
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $firstName = $form['firstName']->getData();
            $lastName = $form['lastName']->getData();
            $bornAt = $form['bornAt']->getData();
            $country = $form['country']->getData();
            $city = $form['city']->getData();
            $address = $form['address']->getData();
            $description = $form['description']->getData();

            $userInfo->setFirstName($firstName);
            $userInfo->setLastName($lastName);
            $userInfo->setBornAt($bornAt);
            $userInfo->setCountry($country);
            $userInfo->setCity($city);
            $userInfo->setAddress($address);
            $userInfo->setDescription($description);
            $userInfo ->setMember($member);

            $em = $this->getDoctrine()->getManager();
            $em->persist($userInfo);
            $em->persist($member);
            $em->flush();

            return $this->redirectToRoute('profileDetails',   array(
                'id' => $userInfo->getId()));
        }

        return $this->render('profile/profileCreate.html.twig',
            array(
                'userInfo' => $userInfo,
                'form' => $form->createView()));

    }

    /**
     * @Route("/profile/profileDetails/{id}", name="profileDetails")
     */
    public function ShowProfileAction($id, Request $request)
    {

        $userInfo = $this->getDoctrine()->getRepository('App:UserInfo')
            ->find($id);


        return $this->render('profile/profileDetails.html.twig',
            array('userInfo' => $userInfo));

    }

    /**
     * @Route("/profile/profileEdit/{id}", name="profileEdit")
     */
    public function ProfileEditAction($id, Request $request)
    {
        $userInfo = $this->getDoctrine()->getRepository('App:UserInfo')
            ->find($id);


        $userInfo->setFirstName($userInfo->getFirstName());
        $userInfo->setLastName($userInfo->getLastName());
        $userInfo->setBornAt($userInfo->getBornAt());
        $userInfo->setCountry($userInfo->getCountry());
        $userInfo->setCity($userInfo->getCity());
        $userInfo->setAddress($userInfo->getAddress());
        $userInfo->setDescription($userInfo->getDescription());


        $form = $this->createFormBuilder($userInfo)
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
            $firstName = $form['firstName']->getData();
            $lastName = $form['lastName']->getData();
            $bornAt = $form['bornAt']->getData();
            $country = $form['country']->getData();
            $city = $form['city']->getData();
            $address = $form['address']->getData();
            $description = $form['description']->getData();

            $em = $this->getDoctrine()->getManager();
            $userInfo = $em->getRepository('App:UserInfo')
                ->find($id);

            $userInfo->setFirstName($firstName);
            $userInfo->setLastName($lastName);
            $userInfo->setBornAt($bornAt);
            $userInfo->setCountry($country);
            $userInfo->setCity($city);
            $userInfo->setAddress($address);
            $userInfo->setDescription($description);

            $em->flush();

            $this->addFlash(
                'notice',
                'Profile Updated'
            );
            return $this->redirectToRoute('profileDetails',   array(
                'id' => $userInfo->getId()));
        }

        return $this->render('profile/profileEdit.html.twig',
            array(
                'userInfo' => $userInfo,
                'form' => $form->createView()));



    }
}

