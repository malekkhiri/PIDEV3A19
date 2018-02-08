<?php

namespace ProjetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class RegisterController extends Controller
{
    public function registerAction()
    {
        return $this->render('ProjetBundle:login:register.html.twig');
    }
}
