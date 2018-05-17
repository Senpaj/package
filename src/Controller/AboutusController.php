<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AboutusController extends Controller
{
    /**
     * @Route("/aboutus", name="aboutus")
     */
    public function index()
    {
        return $this->render('aboutus/info.html.twig', [
            'controller_name' => 'AboutusController',
        ]);
    }
}
