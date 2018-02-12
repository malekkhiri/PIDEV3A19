<?php

namespace ProjetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class BackofficeController extends Controller
{
    public function backAction()
    {
        return $this->render('ProjetBundle:back:index2.html.twig');
    }
}
