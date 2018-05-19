<?php

namespace App\Controller;

use App\Entity\Member;
use App\Form\Type\ResetPasswordEmailType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ResetPasswordController extends Controller
{
    /**
     * @Route("/resetPassword", name="resetPassword")
     */
    public function index(Request $request, \Swift_Mailer $mailer)
    {
        $form = $this->createForm(ResetPasswordEmailType::class);

        $form -> handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $info = $form->getData();

            $email = $info['email'];

            $repository = $this->getDoctrine()->getRepository(Member::class);

            $member = $repository->findOneBy(['email' => $email]);

            if($member != null){

                $random = bin2hex(random_bytes(100));

                $member ->setRecoveryHash($random);

                $em = $this->getDoctrine()->getManager();

                $em->persist($member);
                $em->flush();

                $message = (new \Swift_Message('Slaptazodzio atstatymas'))
                    ->setFrom('skiperispingvinauskas@gmail.com')
                    ->setTo($email)
                    ->setBody(
                        $this->renderView(
                            'email/passwordReset.html.twig',
                            array('email' => $email,
                                'hash' => $random)
                        ),
                        'text/html'
                    );

                $mailer->send($message);

                $this->addFlash('success', 'Toliau sekite instrukcijas, kurias jums atsiunteme i elektronini pasta.');
            } else {
                $this->addFlash('failure', 'Vartotojas su tokiu elektroniniu pastu neegzistuoja. Bandykite dar karta.');

                $this->redirectToRoute('resetPassword');
            }



        }

        return $this->render('reset_password/index.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
