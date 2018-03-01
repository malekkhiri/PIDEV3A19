<?php

namespace ProduitBundle\Controller;

use ProduitBundle\Entity\Commentaire;
use ProduitBundle\Form\CommentaireType;
use ProduitBundle\Form\PromotionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\HttpFoundation\Request;
use ProduitBundle\Entity\Promotion;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PromotionController extends Controller
{
   /* public function AjoutPromotionAction(Request $request,$id)
    {
        $promotion=new Promotion();



        $form=$this->createForm(PromotionType::class,$promotion);
        $form->handleRequest($request);
        if($form->isValid()){


            $em=$this->getDoctrine()->getManager();
            $produit=$em->getRepository("ProduitBundle:Produit")->find($id);
            $promotion->setIdProduit($produit);


            $em->persist($promotion);
            $em->flush();
            return $this->redirectToRoute('produit_Affichage') ;
        }
        return $this->render('ProduitBundle:Produit:Promotion.html.twig',array('prom'=>$form->createView()));
    }*/


    public function updateAction(Request $request,$id)

    {
        $id = $request->get('id');


        $em = $this->getDoctrine()->getManager();

        $promotion = $em->getRepository('ProduitBundle:Promotion')->findOneBy(['id_produit'=>$id]);


        $form = $this->createForm(PromotionType::class, $promotion);
        $form->handleRequest($request);
        if($form->isValid() && $form->isSubmitted())
        {
            $em->persist($promotion);
            $em->flush();
            return $this->redirectToRoute('produit_Affichage') ;
        }
        return $this->render('ProduitBundle:Produit:Promotion.html.twig',array('prom'=>$form->createView()));    }


   /* public function List2Action()

    {
        $em=$this->getDoctrine()->getManager();

        $promotion=$em->getRepository("ProduitBundle:Promotion")->findAll();

        return $this->render('ProduitBundle:client:AfficherProduit.html.twig', array('promotion'=>$promotion
            // ...
        ));
    }*/

    public function ListDetailleAction(Request $request,$id)

    {
        /*$id=$request->get('id');*/

        $em=$this->getDoctrine()->getManager();
/*          $produit=$em->getRepository("ProduitBundle:Produit")->find($id);*/

        $promotion=$em->getRepository("ProduitBundle:Promotion")->findBy(['id_produit'=>$id]);


        return $this->render('ProduitBundle:client:AfficherProduit.html.twig', array('pro'=>$promotion/*,'p'=>$produit*/
            // ...
        ));
    }





}
