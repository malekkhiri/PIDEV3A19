<?php

namespace ProjetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class BackofficeController extends Controller
{
    public function backAction()
    {
        return $this->render('ProjetBundle:back:table.html.twig');
    }
    public function ApprouverAnnonceAction()
    {
        $em = $this->getDoctrine()->getManager();
        $ann = $em->getRepository("VenteLibreBundle:Annonces")->findAll();
        return $this->render('ProjetBundle:back:acceptannonce.html.twig',
            array(
                'a' => $ann

            ));
    }

    public function back2Action(Request $request)
    {
        $notif = $this->get ('mgilet.notification')->getAllUnseen();
        if($request->isXmlHttpRequest ()){
            /*///////////////////////////////////////////////////////////////*/
            foreach ($notif as $n){
                $nn = $this->get('mgilet.notification')->setAsSeen($n);
                $nn->setSeen(1);
                $this->getDoctrine()->getManager()->persist($nn);
                $this->getDoctrine ()->getManager ()->flush ();
            }
            $notif = $this->get('mgilet.notification')->getAllUnseen();
            $count = count($notif);
            return new JsonResponse($count);
        }
        $count = count($notif);
        return $this->render ('ProjetBundle:back:index2.html.twig', array('notif' => $notif,'count'=>$count));
    }
    public function AccepterAction($id)
    {   $em= $this->getDoctrine()->getManager();
        $modele=$em->getRepository("VenteLibreBundle:Annonces")->find($id);
        $modele->setApprouver(1);
        $em->persist($modele);
        $em->flush();
        return $this->redirect($this->generateUrl('appannoce')) ;

    }
    public function SupprimerAnnonceAction($idVenteLibre)
    {

        $em = $this->getDoctrine()->getManager();
        $ann = $em->getRepository("VenteLibreBundle:Annonces")->find($idVenteLibre);
        $em->remove($ann);
        $em->flush();
        return $this->redirect($this->generateUrl('appannoce')) ;
    }
}
