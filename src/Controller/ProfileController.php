<?php

namespace App\Controller;

use App\Form\Type\MemberType;
use App\Entity\UserInfo;
use App\Entity\Member;
use App\Form\Type\ProfileFormType;
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
     * @Route("/profile/create", name="profileCreate")
     */
    public function CreateProfileAction(Request $request)
    {

        $userInfo = new UserInfo();
        $member = $this->getUser();


        $form = $this->createForm(ProfileFormType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $userInfo->setFirstName($form['firstName']->getData());
            $userInfo->setLastName($form['lastName']->getData());
            $userInfo->setBornAt($form['bornAt']->getData());
            $userInfo->setMember($member);


            $em = $this->getDoctrine()->getManager();
            $em->persist($userInfo);
            $em->persist($member);
            $em->flush();


            return $this->redirectToRoute('profileDetails', array(
                'id' => $userInfo->getId()));
        }

        return $this->render('profile/create.html.twig',
            array(
                'userInfo' => $userInfo,
                'form' => $form->createView()));

    }

    /**
     * @Route("/profile/details/{id}", name="profileDetails")
     */
    public function ShowProfileAction($id, Request $request)
    {


        $userInfo = $this->getDoctrine()->getRepository('App:UserInfo')
            ->find($id);

        return $this->render('profile/details.html.twig',
            array('userInfo' => $userInfo));

//
    }

    /**
     * @Route("/profile/edit/{id}", name="profileEdit")
     */
    public function EditProfileAction($id, Request $request)
    {

        $userInfo = $this->getDoctrine()->getRepository('App:UserInfo')
            ->find($id);

        $form = $this->createForm(ProfileFormType::class, $userInfo);
        $userInfo->setFirstName($userInfo->getFirstName());
        $userInfo->setLastName($userInfo->getLastName());
        $userInfo->setBornAt($userInfo->getBornAt());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $member = $this->getUser();
            $userInfo = $member->getUserInfo();

            $userInfo->setFirstName($form['firstName']->getData());
            $userInfo->setLastName($form['lastName']->getData());
            $userInfo->setBornAt($form['bornAt']->getData());

            $em = $this->getDoctrine()->getManager();
            $em->persist($userInfo);
            $em->persist($member);
            $em->flush();

            $this->addFlash(
                'notice',
                'Profile Updated'
            );

            return $this->redirectToRoute('profileDetails', array(
                'id' => $userInfo->getId()));
        }

        return $this->render('profile/edit.html.twig',
            array(
                'userInfo' => $userInfo,
                'form' => $form->createView()));
    }
}

