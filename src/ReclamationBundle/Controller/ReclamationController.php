<?php

namespace ReclamationBundle\Controller;

use ReclamationBundle\Entity\Reclamation;
use ReclamationBundle\Form\ReclamationType;
use ReclamationBundle\Form\RechercherReclamationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ReclamationController extends Controller
{
    public function AjoutAction(Request $request)
    {
        $reclamation = new Reclamation();
        $Form = $this->createForm(ReclamationType::class, $reclamation);

        $Form->handleRequest($request); //elle garde dans une session dans laquel elle stock ce que l'utilisateur a saisie
        $user=$this->getUser();
        if ($Form->isValid())
        {
            $date=new \DateTime('now');

            $em = $this->getDoctrine()->getManager();
            $reclamation->setEmetteur($user);
            $reclamation->setDate($date);
            $em->persist($reclamation);
            $em->flush();
            return $this->redirectToRoute('_affiche');
        }
        return $this->render('ReclamationBundle:Reclamation:ajout.html.twig', array(
            'form' => $Form->createView()
        ));
    }

    public function AfficheAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user=$this->getUser();
        $uid=$user->getId();
        $reclamation = $em->getRepository("ReclamationBundle:Reclamation")->findby(['nomDestinataire'=>$uid]);
        $em = $this->get('doctrine.orm.entity_manager');
        $dql   = "SELECT r FROM ReclamationBundle:Reclamation r ";
        $query = $em->createQuery($dql);

        $paginator  = $this->get('knp_paginator');
        $resultat = $paginator->paginate(
            $reclamation, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            $request->query->getInt('limit',3)/*limit per page*/
        );

        // parameters to template
        return $this->render('ReclamationBundle:Reclamation:affiche.html.twig', array('pagination' => $resultat, 'r'=>$reclamation)
        );
    }

    public function SupprimerAction($idReclamation)
    {
        $em=$this->getDoctrine()->getManager();
        $reclamation = $em->getRepository("ReclamationBundle:Reclamation")->find($idReclamation);
        $em->remove($reclamation);
        $em->flush();
        return $this->redirectToRoute('_affiche');
    }

//    public function RechercheAction(Request $request)
//    {
//        $reclamation=new Reclamation();
//        $em = $this->getDoctrine()->getManager();
//        $Form=$this->createForm(RechercherReclamationFormType::class,$reclamation);
//        $Form->handleRequest($request);
//        $user=$this->getUser();
//        $uid=$user->getId();
//        if($Form->isValid()&& $Form->isSubmitted()){
//            $reclamation = $em->getRepository("ReclamationBundle:Reclamation")->findBy(array('nomDestinataire'=>$reclamation->getNomDestinataire(),'emetteur'=>$uid));
//
//        }else{
//            $reclamation = $em->getRepository("ReclamationBundle:Reclamation")->findBy(['emetteur'=>$uid]);
//        }
//        $em    = $this->get('doctrine.orm.entity_manager');
//        $dql   = "SELECT r FROM ReclamationBundle:Reclamation r";
//        $query = $em->createQuery($dql);
//
//        $paginator  = $this->get('knp_paginator');
//        $resultat = $paginator->paginate(
//            $reclamation, /* query NOT result */
//            $request->query->getInt('page', 1)/*page number*/,
//            $request->query->getInt('limit', 10)/*limit per page*/
//        );
//
//        return $this->render('ReclamationBundle:Reclamation:rechercher.html.twig', array('form'=>$Form->createView(),
//                'pagination' => $resultat, 'r'=>$reclamation)
//        );
//        return $this->render("ReclamationBundle:Reclamation:rechercher.html.twig",
//            array('form'=>$Form->createView(),'r'=>$reclamation));
//    }

//    public function RechercheAction(Request $request){
//        $reclamation=new Reclamation();
//        $em = $this->getDoctrine()->getManager();
//        $reclamation = $em->getRepository("ReclamationBundle:Reclamation")->findAll();
//        $Form=$this->createForm(RechercherReclamationFormType::class,$reclamation);
//        $Form->handleRequest($request);
//        if($request->isXmlHttpRequest()){
//            $reclamation = $em->getRepository("ReclamationBundle:Reclamation")->rechercherDQL($request->get('nomDestinataire'));
//            $s=new Serializer(array(new ObjectNormalizer()));
//            $data=$s->normalize($reclamation);
//            return new JsonResponse($data);
//
//        }
//        return $this->render('ReclamationBundle:Reclamation:rechercher.html.twig', array(
//            'Form' => $Form->createView(),'r'=>$reclamation)
//        );
//
//    }

    public function intAction()
    {
        return $this->render('ReclamationBundle:Reclamation:int.html.twig');
    }

}
