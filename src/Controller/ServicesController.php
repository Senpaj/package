<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ServicesController extends Controller
{
    /**
     * @Route("/services", name="services")
     */
    public function index()
    {
        return $this->render('services/index.html.twig', [
            'controller_name' => 'ServicesController',
        ]);
    }
}
