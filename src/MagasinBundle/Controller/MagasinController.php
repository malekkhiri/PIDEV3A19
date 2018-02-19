<?php

namespace MagasinBundle\Controller;

use MagasinBundle\Entity\Magasin;
use MagasinBundle\Form\MagasinType;
use MagasinBundle\Form\RechercheMagasin;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;



class MagasinController extends Controller
{
    public function AfficheMagasinAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user=$this->getUser();
        $uid=$user->getId();
        $magasin = $em->getRepository("MagasinBundle:Magasin")->findby(['prop_magasin'=>$uid]);
        return $this->render('MagasinBundle:Magasin:affichemagasin.html.twig',
            array(
                'm' => $magasin

            ));
    }
    public function Affiche2MagasinAction()
    {
        $em = $this->getDoctrine()->getManager();
        $magasin = $em->getRepository("MagasinBundle:Magasin")->findAll();
        return $this->render('MagasinBundle:Magasin:affichemagasin.html.twig',
            array(
                'm' => $magasin

            ));
    }


    public function AjoutMagasinAction(Request $request)
    {

        $magasin = new Magasin();
        $Form = $this->createForm(MagasinType::class, $magasin);
        $Form->handleRequest($request);
        if ($Form->isValid()) {
            $magasin->setPropMagasin($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($magasin);
            $em->flush();
            return $this->redirectToRoute('_AfficheMagasin');

        }
        return $this->render('MagasinBundle:Magasin:ajoutmagasin.html.twig', array(
            'form' => $Form->createView()
            // ...
        ));
    }


    public function ModifierMagasinAction(Request $request, $id)
    {
        //$id=$request->get('id');
        $em = $this->getDoctrine()->getManager();
        $magasin = $em->getRepository("MagasinBundle:Magasin")->find($id);
        $Form = $this->createForm(MagasinType::class, $magasin);
        $Form->handleRequest($request);
        if ($Form->isValid()) {
            $em->persist($magasin);
            $em->flush();
            return $this->redirectToRoute('_AfficheMagasin');
        }
        return $this->render('MagasinBundle:Magasin:modifiermagasin.html.twig',
            array('form' => $Form->createView()));


    }

    public function SupprimerMagasinAction(Request $request, $id)
    {
        //$id=$request->get('id');
        $em = $this->getDoctrine()->getManager();
        $magasin = $em->getRepository("MagasinBundle:Magasin")->find($id);
        $Form = $this->createForm(MagasinType::class, $magasin);
        $Form->handleRequest($request);
        $em->remove($magasin);
        $em->flush();


        return $this->redirectToRoute('_AfficheMagasin');

    }

    public function RechercheMagasinAction(Request $request)
    {
        $magasin = new Magasin();
        //$id=$request->get('id');
        $user=$this->getUser();
        $uid=$user->getId();
        $em = $this->getDoctrine()->getManager();
        $Form = $this->createForm(RechercheMagasin::class, $magasin);

        $Form->handleRequest($request);
        if ($Form->isValid()) {

            $magasin = $em->getRepository("MagasinBundle:Magasin")->findBy(array('id_magasin' => $magasin->getIdMagasin()));

        } else {
            $magasin = $em->getRepository("MagasinBundle:Magasin")->findby(['prop_magasin'=>$uid]);


        }
        return $this->render('MagasinBundle:Magasin:recherchermagasin.html.twig',
            array('form' => $Form->createView(), 'magasin' => $magasin));

    }
}