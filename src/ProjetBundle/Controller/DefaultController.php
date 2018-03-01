<?php

namespace ProjetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
   /* public function indexAction()
    {
        return $this->render('ProjetBundle:Default:index.html.twig');
    }*/
   public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $produit = $em->getRepository("ProduitBundle:Produit")->findAll();
        return $this->render('ProjetBundle:Default:index.html.twig',
            array(
                'p' => $produit

            ));
    }

    public function LayoutAction()
    {
        return $this->render('ProjetBundle::Layout.html.twig');
    }
}
