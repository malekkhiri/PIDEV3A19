<?php

namespace MagasinBundle\Controller;

use MagasinBundle\Entity\Magasin;
use MagasinBundle\Form\MagasinType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MagasinController extends Controller
{

    public function AfficheMagasinAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user=$this->getUser();
        $uid=$user->getId()  ;
        $magasin = $em->getRepository("MagasinBundle:Magasin")->findby(['prop_magasin'=>$uid]);
        return $this->render('MagasinBundle:Magasin:affichemagasin.html.twig',
            array(
                'm' => $magasin));
    }


    public function Affiche2MagasinAction()
    {
        $em = $this->getDoctrine()->getManager();
        $magasin = $em->getRepository("MagasinBundle:Magasin")->findAll();
        return $this->render('MagasinBundle:Magasin:affichemagasin.html.twig',
            array(
                'm' => $magasin));
    }


    public function AjoutMagasinAction(Request $request)
    {
        $magasin = new Magasin();
        $Form = $this->createForm(MagasinType::class, $magasin);
        $Form->handleRequest($request);
        // if($Form->isSubmitted() &&  $Form->isValid() && $this->captchaverify($request->get('g-recaptcha-response'))){
        if ($Form->isValid()) {
            $magasin->setPropMagasin($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($magasin);
            $em->flush();
            return $this->redirectToRoute('_attend');
        }
        return $this->render('MagasinBundle:Magasin:ajoutmagasin.html.twig', array(
            'form' => $Form->createView()));
    }
    /*function captchaverify($recaptcha){
        $url = "https://www.google.com/recaptcha/api/siteverify";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, array(
            "secret"=>"6LdDMkgUAAAAAMBJq-a9z8cD8h6zMiHBoWQlh8q8",'remoteip'=> '192.168.43.62',"response"=>$recaptcha));
        $response = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($response);

        return $data->success;
    }*/


    public function ModifierMagasinAction(Request $request, $id)
    {
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
        $em = $this->getDoctrine()->getManager();
        $magasin = $em->getRepository("MagasinBundle:Magasin")->findAll();
        return $this->render('MagasinBundle:Magasin:affichemagasin.html.twig',
            array(
                'magasins' => $magasin));
    }


    public function RechercheIMagasinAction()
    {
        $user=$this->getUser();
        $uid=$user->getId();
        $em = $this->getDoctrine()->getManager();
        $magasin = $em->getRepository("MagasinBundle:Magasin")->findby(['prop_magasin'=>$uid]);
        return $this->render('MagasinBundle:Magasin:affichemagasin.html.twig',
            array(
                'magasins' => $magasin));
    }


    public function validateAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $magasin = $em->getRepository('MagasinBundle:Magasin')->find($id);
        if ($magasin) {
            $magasin=$em->getRepository("MagasinBundle:Magasin")->find($id);
            $magasin->setValidated('1');
            $em->flush();
        }
        $em = $this->getDoctrine()->getManager();
        $magasin = $em->getRepository('MagasinBundle:Magasin')->findAll();
        return $this->render('ProjetBundle:back:afficheadmin.html.twig', array(
            'm' => $magasin));
    }


    public function AfficheMagasinadminAction()
    {
        $em = $this->getDoctrine()->getManager();
        $magasin = $em->getRepository("MagasinBundle:Magasin")->findAll();
        return $this->render('ProjetBundle:back:afficheadmin.html.twig',
            array(
                'm' => $magasin));
    }


    public function SupprimerMagasinadminAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $magasin = $em->getRepository("MagasinBundle:Magasin")->find($id);
        $Form = $this->createForm(MagasinType::class, $magasin);
        $Form->handleRequest($request);
        $em->remove($magasin);
        $em->flush();
        return $this->redirectToRoute('_backmagasin');
    }


    public function attendAction()
    {
        return $this->render('MagasinBundle:Magasin:attend.html.twig');
    }
}