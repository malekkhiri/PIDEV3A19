<?php

namespace EvenementBundle\Controller;

use EvenementBundle\Entity\Commentaire;
use EvenementBundle\Entity\Evenement;
use EvenementBundle\Form\CommentaireType;
use EvenementBundle\Form\EvenementType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class EvenementController extends Controller
{
    public function AjoutAction(Request $request)

    {
        $evenement = new Evenement();
        $Form = $this->createForm(EvenementType::class, $evenement);
        $Form->handleRequest($request);
        if ($Form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($evenement);
            $em->flush();
            return $this->redirectToRoute('_affiche');


        }
        return $this->render('EvenementBundle:Evenement:ajout.html.twig', array(// ...
            'form' => $Form->createView()
        ));

    }

    public function AfficheAction()
    {
        $em = $this->getDoctrine()->getManager();
        $evenement = $em->getRepository("EvenementBundle:Evenement")->findAll();
        return $this->render('EvenementBundle:Evenement:affiche.html.twig',
            array(
                'e' => $evenement

            ));
    }

    public function ModifierAction(Request $request, $id_Evenement)
    {
        $em = $this->getDoctrine()->getManager();
        $evenement = $em->getRepository("EvenementBundle:Evenement")->find($id_Evenement);
        $Form = $this->createForm(EvenementType::class, $evenement);
        $Form->handleRequest($request);
        if ($Form->isValid() && $Form->isSubmitted()) {
            $em->persist($evenement);
            $em->flush();
            return $this->redirectToRoute('_affiche');
        }
        return $this->render('EvenementBundle:Evenement:modifier.html.twig',
            array('e' => $Form->createView()));
    }

    public function SupprimerAction($id_Evenement)
    {

        $em = $this->getDoctrine()->getManager();
        $evenement = $em->getRepository("EvenementBundle:Evenement")->find($id_Evenement);
        $em->remove($evenement);
        $em->flush();
        return $this->redirectToRoute('_affiche');
    }
    public function Affiche2Action()
    {
        $em = $this->getDoctrine()->getManager();
        $evenement = $em->getRepository("EvenementBundle:Evenement")->findAll();
        return $this->render('EvenementBundle:Evenement:affiche2.html.twig',
            array(
                'e' => $evenement

            ));
    }
    public function AfficheEventAction($id_Evenement)
    {
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository("EvenementBundle:Evenement")->find($id_Evenement);
        return $this->render('EvenementBundle:Evenement:SingleEvent.html.twig', array(
            'event'=>$event
        ));
    }
    public function TestAction()
    {

        return $this->render('EvenementBundle:Evenement:test.html.twig', array(

        ));
    }
//    public function CommentAction(Request $request, Evenement $event)
//    {
//
//        $commentaire = new Commentaire();
//        $Form = $this->createForm(CommentaireType::class, $commentaire);
//        $Form->handleRequest($request);
//        if ($Form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $user=$this->getUser();
//            $commentaire->setCommentator($user);
//            $date = new \DateTime();
//            $commentaire->setCreationDate($date);
//            $commentaire->setCommented($event);
//            $em->persist($commentaire);
//            $em->flush();
////            return $this->redirectToRoute('_affiche2');
//            $Form = $this->createForm(CommentaireType::class, $commentaire);
//
//            return $this->render('EvenementBundle:Commentaire:ajoutCommentaire.html.twig', array(// ...
//                'form' => $Form->createView()
//            ));
//        }
//        return $this->render('EvenementBundle:Commentaire:ajoutCommentaire.html.twig', array(// ...
//            'form' => $Form->createView()
//        ));
//    }
}