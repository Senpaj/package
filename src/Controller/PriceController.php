<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PriceController extends Controller
{
    /**
     * @Route("/prices", name="prices")
     */
    public function ShowPricesAction()
    {
        return $this->render('price/price.html.twig');
    }
}
