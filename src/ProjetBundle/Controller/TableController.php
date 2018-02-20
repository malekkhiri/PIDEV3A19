<?php

namespace ProjetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class TableController extends Controller
{
    public function tableAction()
    {
        return $this->render('ProjetBundle:back:tables.html.twig');
    }

    public function evenementAction()
    {
        return $this->render('ProjetBundle:back:evenment.html.twig');
    }


}
