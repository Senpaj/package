<?php

namespace App\Controller;

use App\Entity\Orders;
use App\Form\Type\MemberTypeAdminEdit;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Routing\Annotation\Route;

class MyOrdersController extends Controller
{
    /**
     * @Route("/myorders", name="myorders")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function ordersAction(Request $request)
    {


        $em = $this->getDoctrine()->getManager();

        $User = $this->getUser();
        if(in_array('ROLE_ADMIN', $User->getRoles()) ||
            in_array('ROLE_MECHANIC', $User->getRoles()))
                $orders = $em->getRepository('App:CustomerOrder')->findAll();

        else {
            $orders = $em->getRepository('App:CustomerOrder')
                ->findBy(
                    ['fk_client' => $User->getId()]
                );
        }


        $paginator  = $this->get('knp_paginator' );
        $pagination = $paginator->paginate(
            $orders,
            $request->query->getInt('page', 1)/*page number*/,
            10/*limit per page*/
        );

        return $this->render('my_orders/my_orders.html.twig', [
            'pagination' => $pagination
        ]);
    }
}
