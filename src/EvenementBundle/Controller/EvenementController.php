<?php

namespace EvenementBundle\Controller;

use EvenementBundle\Entity\Evenement;
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
    public function calendrierAction()
    {
        return $this->render('EvenementBundle:Evenement:calendrier.html.twig',
            array());
    }
}