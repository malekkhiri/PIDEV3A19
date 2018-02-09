<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class rechController extends Controller
{
    public function rechercheAction()
    {
        return $this->render('AdminBundle:Default:recherche.html.twig');
    }
}
