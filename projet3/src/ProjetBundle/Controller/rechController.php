<?php

namespace ProjetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class rechController extends Controller
{
    public function rechercheAction()
    {
        return $this->render('ProjetBundle:Default:recherche.html.twig');
    }
}
