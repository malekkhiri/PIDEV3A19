<?php

namespace VenteLibreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use VenteLibreBundle\Entity\Annonces;
use VenteLibreBundle\Entity\AnnonceRepository;
use VenteLibreBundle\Form\AnnoncesType;
use VenteLibreBundle\Form\rechercheAnnoncesFormType;

class AnnoncesController extends Controller
{
    public function AjoutAction(Request $request)

    {
        $ann = new Annonces();
        $Form = $this->createForm(AnnoncesType::class, $ann);
        $Form->handleRequest($request);
        $id_user = $this/*get('security.token_storage')->getToken()*/->getUser();
        if ($Form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $ann-> setUser($id_user);
            $em->persist($ann);
            $em->flush();
            return $this->redirectToRoute('affiche_vente');

        }
        return $this->render('VenteLibreBundle:Annonces:ajout.html.twig', array(// ...
            'form' => $Form->createView()
        ));

    }
    public function AfficheAction()
    {
        $em = $this->getDoctrine()->getManager();
        $id_user = $this->get('security.token_storage')->getToken()->getUser();
        $ann = $em->getRepository("VenteLibreBundle:Annonces")->FindmyAnnonces($id_user);
        return $this->render('VenteLibreBundle:Annonces:affiche.html.twig',
            array(
                'a' => $ann

            ));
    }

    public function ModifierAction(Request $request, $idVenteLibre)
    {
        $em = $this->getDoctrine()->getManager();
        $ann = $em->getRepository("VenteLibreBundle:Annonces")->find($idVenteLibre);
        $Form = $this->createForm(AnnoncesType::class, $ann);
        $Form->handleRequest($request);
        if ($Form->isValid() && $Form->isSubmitted()) {
            $ann->setApprouver(0);
            $em->persist($ann);
            $em->flush();
            return $this->redirectToRoute('affiche_vente');
        }
        return $this->render('VenteLibreBundle:Annonces:modifier.html.twig',
            array('a' => $Form->createView()));
    }

    public function SupprimerAction($idVenteLibre)
    {

        $em = $this->getDoctrine()->getManager();
        $ann = $em->getRepository("VenteLibreBundle:Annonces")->find($idVenteLibre);
        $em->remove($ann);
        $em->flush();
        return $this->redirectToRoute('affiche_vente');
    }

    public function RechercheAction(Request $request){
        $ann=new Annonces();
        $em = $this->getDoctrine()->getManager();
        $Form=$this->createForm(rechercheAnnoncesFormType::class,$ann);
        $Form->handleRequest($request);
        if($Form->isValid()&& $Form->isSubmitted()){
            $ann = $em->getRepository("VenteLibreBundle:Annonces")->findBy(array('titre'=>$ann->getTitre()));

        }else{
            $ann = $em->getRepository("VenteLibreBundle:Annonces")->findAll();
        }
        return $this->render("VenteLibreBundle:Annonces:recherche.html.twig",
            array('Form'=>$Form->createView(),'m'=>$ann));
    }
    public function AfficheToutAction()
    {
        $em = $this->getDoctrine()->getManager();
        $ann = $em->getRepository("VenteLibreBundle:Annonces")->findAll();
        return $this->render('VenteLibreBundle:Annonces:annonces.html.twig',
            array(
                'a' => $ann

            ));
    }
    public function ViewAction($id)
    {
        $em= $this->getDoctrine()->getManager();
        $anno=$em->getRepository("VenteLibreBundle:Annonces")->find($id);
        return $this->render('VenteLibreBundle:Annonces:viewannance.html.twig',
            array('annonce' => $anno));
    }
}
