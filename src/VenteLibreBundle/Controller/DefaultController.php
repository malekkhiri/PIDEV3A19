<?php

namespace VenteLibreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('VenteLibreBundle:Default:index.html.twig');
    }
}
