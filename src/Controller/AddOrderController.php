<?php

namespace App\Controller;

use App\Form\Type\OrderEditFormType;
use App\Entity\Member;
use App\Form\Type\OrderFormType;
use App\Entity\UserInfo;
use App\Entity\CustomerOrder;
use App\Form\Type\ProfileFormType;
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
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;



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
            $customerOrder->setauto_make($form['auto_make']->getData());
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

    /**
     * @Route("/edit/order/{id}", name="edit_order")
     */
    public function EditOrder($id, Request $request, \Swift_Mailer $mailer)
    {
        $customerOrder = $this->getDoctrine()->getRepository('App:CustomerOrder')->find($id);

        $form = $this->createForm(OrderEditFormType::class,$customerOrder);
        $customerOrder->setDescription($customerOrder->getDescription());
        $customerOrder->setStatus($customerOrder->getStatus());
        $status1 = $customerOrder->getStatus();

        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()) {

            $customerOrder->setDate($form['date']->getData());
            $customerOrder->setDescription($form['description']->getData());
            $customerOrder->setStatus($form['status']->getData());


            $em = $this->getDoctrine()->getManager();
            $em->persist($customerOrder);
            $em->flush();

            $client = $customerOrder->getfk_client();
            $repository = $this->getDoctrine()->getRepository('App:Member');

            $member = $repository->findOneBy(['id' => $client]);

            $email = $member->getEmail();

            $status2 = $customerOrder->getStatus();
            if($status1 != $status2 && $status2 == '2'){
                $message = (new \Swift_Message('Jūsų automobilis paruoštas'))
                    ->setFrom('skiperispingvinauskas@gmail.com')
                    ->setTo($member->getEmail())
                    ->setBody(
                        $this->renderView(
                            'email/orderFinished.html.twig'),
                        'text/html'

                    );

                $mailer->send($message);
            }

            if($status1 != $status2 && $status2 == '0'){
                $message = (new \Swift_Message('Jūsų užsakymas atšauktas'))
                    ->setFrom('skiperispingvinauskas@gmail.com')
                    ->setTo($member->getEmail())
                    ->setBody(
                        $this->renderView(
                            'email/orderCanceled.html.twig'),
                        'text/html'

                    );

                $mailer->send($message);
            }

            return $this->redirectToRoute('myorders');
        }

        return $this->render('add_order/edit.html.twig',
            array(
                'customerOrder' => $customerOrder,
                'form' => $form->createView()));

    }
}
