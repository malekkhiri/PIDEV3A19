<?php

namespace ProjetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class LoginController extends Controller
{
    public function loginAction()
    {
        return $this->render('ProjetBundle:login:login.html.twig');
    }
}
