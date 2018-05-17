<?php

namespace App\Controller;

use App\Form\Type\OrderFormType;
use App\Entity\UserInfo;
use App\Entity\CustomerOrder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Form\FormTypeInterface;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;



class AddOrderController extends Controller
{
    /**
     * @Route("/add/order", name="add_order")
     */
    public function InsertOrder(Request $request)
    {
        $customerOrder = new CustomerOrder();
        $member = $this->getUser();


        $form = $this->createForm(OrderFormType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $customerOrder->setDate($form['date']->getData());
            $customerOrder->setfk_client($member->getId());
            $customerOrder->setDescription($form['description']->getData());
            $customerOrder->setauto_make($form['make']->getData());
            $customerOrder->setauto_model($form['model']->getData());
            $customerOrder->setStatus("1");


            $em = $this->getDoctrine()->getManager();
            $em->persist($customerOrder);
            $em->flush();


            return $this->redirectToRoute('myorders');
        }

        return $this->render('add_order/index.html.twig',
            array(
                'customerOrder' => $customerOrder,
                'form' => $form->createView()));

    }
}
