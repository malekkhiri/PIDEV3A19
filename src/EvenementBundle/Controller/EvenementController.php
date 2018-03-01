<?php

namespace EvenementBundle\Controller;

use EvenementBundle\Entity\Commentair;
use EvenementBundle\Entity\Evenement;
use EvenementBundle\Form\CommentaireType;
use EvenementBundle\Form\EvenementType;
use EvenementBundle\Form\rechercheFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class EvenementController extends Controller
{
    public function AjoutAction(Request $request)

    {
        $evenement = new Evenement();
        $evenement->setDateDebut(new \DateTime('now'));
        $evenement->setDateFin(new \DateTime('now'));
        $Form = $this->createForm(EvenementType::class, $evenement);
        $Form->handleRequest($request);
        if ($Form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($evenement);
            $evenement->setNbParticipe(0);
            $evenement->setUsersParticipate(Null);
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

    public function ModifierAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $evenement = $em->getRepository("EvenementBundle:Evenement")->find($id);
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

    public function SupprimerAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $evenement = $em->getRepository("EvenementBundle:Evenement")->find($id);
        $em->remove($evenement);
        $em->flush();
        return $this->redirectToRoute('_affiche');
    }
    public function AfficheDQLAction()
    {
        $em = $this->getDoctrine()->getManager();
        $evenement = $em->getRepository("EvenementBundle:Evenement")->dateDQL();
        return $this->render('EvenementBundle:Evenement:affiche2.html.twig',
            array(
                'e' => $evenement

            ));
    }

    public function AfficheEventAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository("EvenementBundle:Evenement")->find($id);
        return $this->render('EvenementBundle:Evenement:SingleEvent.html.twig', array(
            'event'=>$event
        ));
    }


    public function Recherche1Action()
    {
        $em = $this->getDoctrine()->getManager();
        $evenement = $em->getRepository("EvenementBundle:Evenement")->findAll();
        return $this->render('EvenementBundle:Evenement:recherche.html.twig',
            array(
                'evenements' => $evenement

            ));
    }

      public function RechercheAction(Request $request)
    {

        if($request->isXmlHttpRequest() && $request->isMethod('post')){

            $nomEvenement =$request->get('nomEvenement');
            $em = $this->getDoctrine()->getManager();
            $query =$em->getRepository('EvenementBundle:Evenement')->createQueryBuilder('u');
            $evenement= $query->where($query->expr()->like('u.nomEvenement',':p'))
                ->setParameter('p','%'.$nomEvenement.'%')
                ->getQuery()->getResult();

            $response = $this->renderView('EvenementBundle:Evenement:recherche.html.twig',array('all'=>$evenement));
            return  new JsonResponse($response) ;
        }
        return new JsonResponse(array("status"=>true));




    }

    function ifExist($arr, $user)
    {
        foreach ($arr as $item) {
            if ($item == $user) {
                return true;
            }
        }
        return false;
    }

    public function ParticiperAction(Request $request, $id){
        $em = $this->getDoctrine()->getManager();
        $participe = $em->getRepository("EvenementBundle:Evenement")->find($id);
        $user=$this->get('security.token_storage')->getToken()->getUser();
        if($this->ifExist($participe->getUsersParticipate(),$user))
        {
            $participe->removeUsersParticipate($user);
            $participe->setNbParticipe($participe->getNbParticipe() - 1);
        }
        else{
            $participe->addUsersParticipate($user);
            $participe->setNbParticipe($participe->getNbParticipe() + 1);
        }
        $em->flush();
        return $this->redirectToRoute('_affiche2');
    }
}