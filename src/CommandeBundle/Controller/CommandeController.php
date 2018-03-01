<?php
/**
 * Created by PhpStorm.
 * User: Louay Baccary
 * Date: 20/02/2018
 * Time: 20:31
 */

namespace CommandeBundle\Controller;


use ProduitBundle\Controller\ProduitController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use ProduitBundle\Entity\Produit;
use CommandeBundle\Entity\Commande;
use Symfony\Component\HttpFoundation\Response;

class CommandeController extends ProduitController
{
//    public function afficherProduitAction()
//    {
//        $m=$this-> getDoctrine()->getManager();//service fi west l ORM
//        $mark =$m->getRepository('ProduitBundle:Produit')->findAll();
//        return $this->render('CommandeBundle:Produit:afficher.html.twig', array(
//            "m"=>$mark
//            // ...
//        ));
//    }
    public function ajoutPanierAction(Request $request, $id)
    {

//        if (is_object($this->getUser())) {


        $em = $this->getDoctrine()->getManager();

        $pr = $em->getRepository('ProduitBundle:Produit')->find($id);
        $p = new Commande();
        $p->setIdProduit($pr);
        if ($p->getIdProduit()->getQuantite() == 0) {
            return $this->render('CommandeBundle:Default:noajout.html.twig');
        } else


           /* $p->setQte(1);*/
        $p->getIdProduit()->setQuantite($p->getIdProduit()->getQuantite()-1);

        $em->persist($p);
        $em->flush();

        return $this->redirectToRoute('list');

    }
    public function ViderPanierAction()
    {
        $m = $this->getDoctrine()->getManager();
        $mark = $m->getRepository('CommandeBundle:Commande')->findAll();
        foreach ($mark as $commande) {
            $m->remove($commande);
            $m->flush();
        }
        return $this->render('CommandeBundle:Default:PanierVide.html.twig');
    }

    public function AfficherPanierAction()
    {

        $em = $this->getDoctrine()->getManager();
        $commande = $em->getRepository("CommandeBundle:Commande")->findAll();
        if ($commande==NULL)
        {
            return $this->render('CommandeBundle:Default:PanierVide.html.twig');
        }
        else

            return $this->render('CommandeBundle:Default:AfficherPanier.html.twig' , array('m' => $commande
                // ...
            ));


    }

    public function supprimerCommandeAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $mark = $em->getRepository('CommandeBundle:Commande')->find($id);
        $em->remove($mark);
//        $em = $this->getDoctrine()->getManager();

        $pr = $em->getRepository('ProduitBundle:Produit')->find($mark->getIdProduit());

        $pr->setQuantite($pr->getQuantite()+1);

        $em->persist($pr);
        $em->flush();

        $em->flush();
        return $this->redirectToRoute('Afficher_Panier');
    }

    public function ValiderAction()
    {
        $m = $this->getDoctrine()->getManager();
        $mark = $m->getRepository('CommandeBundle:Commande')->findAll();
//        foreach ($mark as $commande)
//        {
//            $m->remove($commande);
//            $m->flush();
//        }
        return $this->render('CommandeBundle:Default:Facture.html.twig', array('m' => $mark));
    }

    public function pdfAction()
    {
        $m = $this->getDoctrine()->getManager();
        $mark = $m->getRepository('CommandeBundle:Commande')->findAll();
        $snappy = $this->get('knp_snappy.pdf');

        $html = $this->renderView('CommandeBundle:Default:FacturePDF.html.twig', array('m' => $mark
            //..Send some data to your view if you need to //
        ));

        $filename = 'myFirstSnappyPDF';

        return new Response(
            $snappy->getOutputFromHtml($html),
            200,
            array(
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="' . $filename . '.pdf"'
            )
        );
    }
//    public function MAilAction(){
//
//}

    public function RechercheAction(Request $request)
    {

        if($request->isXmlHttpRequest() && $request->isMethod('post')){

            $nomProduit =$request->get('nom');
            $em = $this->getDoctrine()->getManager();
            $query =$em->getRepository('CommandetBundle:Commande')->createQueryBuilder('u');
            $evenement= $query->where($query->expr()->like('u.id_Produit.nomProduit',':p'))
                ->setParameter('p','%'.$nomProduit.'%')
                ->getQuery()->getResult();

            $response = $this->renderView('CommandetBundle:Commande:Afficher2Panier.html.twig',array('all'=>$evenement));
            return  new JsonResponse($response) ;
        }
        return new JsonResponse(array("status"=>true));




    }


}