<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SupportController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function supportAction(Request $request)
    {
        return $this->render('support/index.html.twig');
    }
}