<?php

namespace App\Controller;

use App\Entity\Member;
use App\Form\Type\MemberTypeAdminEdit;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Routing\Annotation\Route;


class DashboardController extends Controller
{
    /**
     * @Route("/dashboard", name="dashboard")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function dashboardAction(Request $request)
    {


        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('App:Member')->findAll();


        $paginator  = $this->get('knp_paginator' );
        $pagination = $paginator->paginate(
            $users,
            $request->query->getInt('page', 1)/*page number*/,
            10/*limit per page*/
        );

        return $this->render('dashboard/dashboard.html.twig', [
            'pagination' => $pagination
        ]);
    }

    /**
     * @Route("/edituser/{id}", name="user.edit")
     * @ParamConverter("user", class="App\Entity\Member")
     * @param Member $user
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editUserAction(Request $request, Member $user){
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(MemberTypeAdminEdit::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em->persist($user);
            $em->flush();
        }
        return $this->render('dashboard/editUser.html.twig', [
            'user' => $user,
            'form' => $form->createView()
        ]);
    }
}
