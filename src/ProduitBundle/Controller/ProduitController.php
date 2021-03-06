<?php

namespace ProduitBundle\Controller;

use ProduitBundle\Entity\Avis;
use ProduitBundle\Entity\Commentaire;
use ProduitBundle\Entity\Evaluation;
use ProduitBundle\Entity\Produit;
use ProduitBundle\Entity\Promotion;
use ProduitBundle\Form\AvisType;
use ProduitBundle\Form\CommentaireType;
use ProduitBundle\Form\Produit2Type;
use ProduitBundle\Form\Produit3Type;
use ProduitBundle\Form\ProduitType;
use ProduitBundle\Form\PromotionType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use TwitterPhp\Connection\User;

class ProduitController extends Controller
{

  /*  public function AjoutAction(Request $request)
    {
        $produit=new Produit();
        $user=$this->getUser();
        if ($request->isMethod('POST'))
        {

            $produit->setNomProduit($request->get('Nom_Produit'));
            $produit->setPrix($request->get('Prix'));
            $produit->setQuantite($request->get('Quantite'));
            $produit->setDescription($request->get('Description'));
            $produit->setIdUtilisateur($user);


            $em=$this->getDoctrine()->getManager();
            $em->persist($produit);
            $em->flush();
            return $this->redirectToRoute('produit_Affichage') ;
        }

        return $this->render('ProduitBundle:Produit:Ajout.html.twig', array(
            // ...
        ));
    }*/



    public function AjoutAction(Request $request,$id)
    {

        $produit=new Produit();
        $em = $this->getDoctrine()->getManager();
        $user=$this->getUser();
        $form = $this->createForm(ProduitType::class, $produit);

        $form->handleRequest($request);

        if ($form->isValid()) {
            // $file stores the uploaded PDF file
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $magasin=$em->getRepository("MagasinBundle:Magasin")->find($id);

            $file = $produit->getBrochure();
            $produit->setIdUtilisateur($user);
            $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();

            // moves the file to the directory where brochures are stored
            $file->move(
                $this->getParameter('brochures_directory'),
                $fileName
            );

            // updates the 'brochure' property to store the PDF file name
            // instead of its contents
            $produit->setBrochure($fileName);
            $produit->setIdMagasin($magasin);

            // ... persist the $product variable or any other work
            $em = $this->getDoctrine()->getManager();//entity manager pour utiliser le persiste eet le flush
            $em->persist($produit);
            $em->flush();
            $manager = $this->get ('mgilet.notification');
            $notif = $manager->createNotification ('L utilisateur   '.$user->getUsername()  .'  a envoyé une demande ajout de Produit');
            $notif->setMessage ('Ajouter Produit ');

            $notif->setLinK ('http://symfony.com/');

            $manager->addNotification (array($this->getUser ()), $notif, true);

            return $this->redirect($this->generateUrl('attente_admine'));
        }



        return $this->render('ProduitBundle:Produit:ajout.html.twig', array('p' => $form->createView()));
    }


    public function RechercheAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $produit = $em->getRepository("ProduitBundle:Produit")->findAll();
        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $paginator=$this->get('knp_paginator');
        dump(get_class($paginator));
       $result= $paginator->paginate(
            $produit,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',3)

        );
        return $this->render('ProduitBundle:Produit:List.html.twig',
            array(
                'p' => $produit,'produit'=>$result

            ));
    }


    /**
     * @return string
     */
    private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }
    public function AfficheAction()

    {
        $em=$this->getDoctrine()->getManager();
        $user=$this->getUser();
        $uid=$user->getId();



        $produit=$em->getRepository("ProduitBundle:Produit")->findby(['id_utilisateur'=>$uid]);
/*        $produit=$em->getRepository("ProduitBundle:Produit")->findby(['id_magasin'=>$idm]);*/

        $promotion=$em->getRepository("ProduitBundle:Promotion")->findby(['id_utilisateur'=>$uid]);

        return $this->render('ProduitBundle:Produit:affichage.html.twig', array('p'=>$produit,'prom'=>$promotion
            // ...
        ));
    }
    public function AfficheMPAction(Request $request)

    {
        $em=$this->getDoctrine()->getManager();


        $id=$request->get('id');


        /*        $produit=$em->getRepository("ProduitBundle:Produit")->findby(['id_utilisateur'=>$uid]);*/
        $produit=$em->getRepository("ProduitBundle:Produit")->findby(['id_magasin'=>$id]);


        return $this->render('ProduitBundle:Produit:produit_magasin.html.twig', array('p'=>$produit,
            // ...
        ));
    }

    public function ListAction(Request $request)

    {


        $em=$this->getDoctrine()->getManager();
        $produit=$em->getRepository("ProduitBundle:Produit")->findAll();



        return $this->render('ProduitBundle:Produit:List.html.twig', array('p'=>$produit
            // ...
        ));
    }
    public function List2Action(Request $request)

    {
        $em=$this->getDoctrine()->getManager();
        $produit=$em->getRepository("ProduitBundle:Produit")->findAll();
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
        return $this->render('ProjetBundle:back:ProdTable.html.twig', array('p'=>$produit,'count'=>$count,'notif' => $notif
            // ...
        ));
    }

    public function validateAction(Request $request,$id)
    {
        $promotion=new Promotion();

        $datedebut=new \DateTime('now');
        $datefin=new \DateTime();

        $em = $this->getDoctrine()->getManager();
        $produit = $em->getRepository('ProduitBundle:Produit')->find($id);
        $form=$this->createForm(PromotionType::class,$promotion);
        $form->handleRequest($request);

        if ($produit) {
            $produit=$em->getRepository("ProduitBundle:Produit")->find($id);
            $promotion->setIdProduit($produit);
            $produit->setValidated('1');
            $promotion->setPourcentage('0');
            $idu=$produit->getIdUtilisateur();
            $promotion->setIdUtilisateur($idu);
            $promotion->setDateDebut($datedebut);
            $promotion->setDateFin($datefin);
            $em->persist($promotion);
            $em->flush();
            $em->flush();
        }
        $em = $this->getDoctrine()->getManager();

        $produit = $em->getRepository('ProduitBundle:Produit')->findAll();

        return $this->render('ProjetBundle:back:ProdTable.html.twig', array(
            'p' => $produit,
        ));
    }
    public function AjoutPromotionAction(Request $request,$id)
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
    }

    public function suprAction(Request $request,$id)

    {
        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();

        $produit = $em->getRepository('ProduitBundle:Produit')->find($id);

            $em->remove($produit);
        $em->flush();
        $produit = $em->getRepository('ProduitBundle:Produit')->findAll();


        return $this->render('ProjetBundle:back:ProdTable.html.twig', array('p'=>$produit
        ));
    }





    public function updateAction(Request $request,$id)

    {
        $id=$request->get('id');
        $em=$this->getDoctrine()->getManager();
        $produit=$em->getRepository('ProduitBundle:Produit')->find($id);


        $form=$this->createForm(Produit2Type::class,$produit);
        $form->handleRequest($request);
        $form = $this->createForm(Produit3Type::class, $produit);
        $form->handleRequest($request);
      /*  if ($form->isValid() && $form->isSubmitted()) {
            $em->persist($produit);
            $em->flush();
            return $this->redirectToRoute('produit_Affichage');
        }*/



        if($form->isValid() && $form->isSubmitted())
        {// $file stores the uploaded PDF file
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $produit->getBrochure();

            $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();

            // moves the file to the directory where brochures are stored
            $file->move(
                $this->getParameter('brochures_directory'),
                $fileName
            );

            // updates the 'brochure' property to store the PDF file name
            // instead of its contents
            $produit->setBrochure(  $fileName);

            // ... persist the $product variable or any other work

            $em->persist($produit);
            $em->flush();
            return $this->redirectToRoute('produit_Affichage') ;
        }
        return $this->render('ProduitBundle:Produit:modifierimage.html.twig',array('p'=>$form->createView()));
    }

   /* public function modifierAction(Request $request, $id)

    {
        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $produit = $em->getRepository('ProduitBundle:Produit')->find($id);
        $form = $this->createForm(Produit3Type::class, $produit);
        $form->handleRequest($request);
        if ($form->isValid() && $form->isSubmitted()) {
            $em->persist($produit);
            $em->flush();
            return $this->redirectToRoute('produit_Affichage');
        }
        return $this->render('ProduitBundle:Produit:modifier.html.twig', array('p' => $form->createView()));
    }*/

   /* public function updateAction(Request $request,$id)

    {
        $id=$request->get('id');
        $em=$this->getDoctrine()->getManager();
        $produit=$em->getRepository('ProduitBundle:Produit')->find($id);
        $form=$this->createForm(Produit3Type::class,$produit);
        $form->handleRequest($request);
        if($form->isValid() && $form->isSubmitted())
        {

            $em->persist($produit);
            $em->flush();
            return $this->redirectToRoute('produit_Affichage') ;
        }
        return $this->render('ProduitBundle:Produit:modifier.html.twig',array('p'=>$form->createView()));
    }*/

    public function supAction(Request $request,$id)

    {
        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $produit = $em->getRepository('ProduitBundle:Produit')->findby(['id_Produit' => $id]);
        $promotion = $em->getRepository('ProduitBundle:Promotion')->findBy(['id_produit' => $id]);
        $commentaire = $em->getRepository('ProduitBundle:Commentaire')->findby(['commentedproduct' => $id]);
        $evaluation = $em->getRepository('ProduitBundle:Evaluation')->findby(['id_produit' => $id]);
        $commande = $em->getRepository('CommandeBundle:Commande')->findby(['id_Produit' => $id]);
        /*        $evaluation=$em->getRepository('ProduitBundle:Evaluation')->findBy()*/

        foreach ($produit as $product) {
            $em->remove($product);
        }
        foreach ($promotion as $prom) {
            $em->remove($prom);
        }
        foreach ($commentaire as $comm){
            $em->remove($comm);
    }
        foreach ($evaluation as $eva){
            $em->remove($eva);
        }
        foreach ($commande as $commande){
            $em->remove($commande);
        }
            $em->flush();



        return $this->redirectToRoute('produit_Affichage',array());    }


   public function ListDetaille2Action(Request $request,$id)

    {
        /*$id=$request->get('id');*/

        $em=$this->getDoctrine()->getManager();
       $produit=$em->getRepository("ProduitBundle:Produit")->find($id);
        $promotion=$em->getRepository("ProduitBundle:Promotion")->findOneBy(['id_produit'=>$id]);



        return $this->render('ProduitBundle:client:AfficherProduit.html.twig', array('pro'=>$promotion,'p'=>$produit
            // ...
        ));
    }

    public function ListDetailleAction(Request $request,$id)

    {
        $avis= new Avis();
        $user=$this->getUser();

        $form1= $this->createForm(AvisType::class,$avis);

        $form1->handleRequest($request);
        if ($form1->isSubmitted())
        {
            $em =$this->getDoctrine()->getManager();

            $produit=$em->getRepository("ProduitBundle:Produit")->findOneBy(array('id_Produit'=>$id));
$avis->setIdProduit($produit);
            $avis->setIdUtilisateur($user);
            $em->persist($avis);
            $em->flush();
        }
        /*$id=$request->get('id');*/

        $em=$this->getDoctrine()->getManager();
        $produit=$em->getRepository("ProduitBundle:Produit")->find($id);
        $promotion=$em->getRepository("ProduitBundle:Promotion")->findOneBy(['id_produit'=>$id]);

        $avis=$em->getRepository("ProduitBundle:Avis")->findBy(array('id_produit'=>$id));
        $evaluation= $em->getRepository('ProduitBundle:Evaluation')->findBy(['appreciate'=> 1 , 'id_produit'=>$produit ]);
        $nblike=count($evaluation);
        $evaluation= $em->getRepository('ProduitBundle:Evaluation')->findBy(['appreciate'=> 2 ,'id_produit'=>$produit ]);
        $nbdislike=count($evaluation);
        $commentaire= $em->getRepository('ProduitBundle:Commentaire')->findBy(['commentedproduct'=>$produit ]);
        $com=count($commentaire);
        $commande= $em->getRepository('CommandeBundle:Commande')->findBy(['id_Produit'=>$produit ]);
        $co=count($commande);

        $commentaire=new Commentaire();
        $form=$this->createForm(CommentaireType::class);
        $form->handleRequest($request);
        if($form->isValid() && $form->isSubmitted())
        {$content=$form->getData()->getContenu();
            $em->persist($commentaire);
            $user=$this->getUser();
            $commentaire->setCommentator($user);
            $date = new \DateTime('now');
            $commentaire->setCreationDate($date);
            $commentaire->setCommentedproduct($produit);
            $commentaire->setContenu($content);
            $em->flush($commentaire);


            $commentaires=$em->getRepository("ProduitBundle:Commentaire")->findBy(['commentedproduct'=>$id]);
            unset($form);
            $form=$this->createForm(CommentaireType::class);


            return $this->render('ProduitBundle:client:AfficherProduit.html.twig', array('com'=>$com,'avis'=>$avis,'form1'=>$form1->createView(),
'nbdislike'=>$nbdislike,'commande'=>$co,'nblike'=>$nblike,'pro'=>$promotion,'p'=>$produit,'form'=>$form->createView(),'c'=>$commentaires
                // ...
            ));
        }
        $commentaires=$em->getRepository("ProduitBundle:Commentaire")->findBy(['commentedproduct'=>$id]);


        return $this->render('ProduitBundle:client:AfficherProduit.html.twig', array('com'=>$com,'avis'=>$avis,'form1'=>$form1->createView(),'commande'=>$co,'nbdislike'=>$nbdislike,'nblike'=>$nblike,'pro'=>$promotion,'p'=>$produit,'form'=>$form->createView(),'c'=>$commentaires
            // ...
        ));
    }
    public function likeAction( Produit $produit)
    {

        $em = $this->getDoctrine()->getManager();
        $user=$this->getUser();
        $uid=$user->getid();
        $evaluation = new Evaluation();

        $evaluation= $em->getRepository('ProduitBundle:Evaluation')->findOneBy(['id_utilisateur' => $uid,'id_produit'=>$produit]);
        if(!$evaluation){
            $evaluation = new Evaluation();

            $em = $this->getDoctrine()->getManager();
            $em->persist($evaluation);
            $user=$this->getUser();
            $evaluation->setIdUtilisateur($user);
            $evaluation->setIdProduit($produit);
            $evaluation->setAppreciate(1);
            $em->flush();}
        else
        {
            $evaluation->setAppreciate(1);
            $em->flush();



        }

        return $this->redirectToRoute('afficher_Produit', array('id' => $produit->getIdProduit()));
    }
    public function dislikeAction( Produit $produit)
    {

        $em = $this->getDoctrine()->getManager();
        $user=$this->getUser();
        $uid=$user->getid();

        $evaluation= $em->getRepository('ProduitBundle:Evaluation')->findOneBy(['id_utilisateur' => $uid,'id_produit'=>$produit]);
        if(!$evaluation){
            $evaluation = new Evaluation();

            $em = $this->getDoctrine()->getManager();
            $em->persist($evaluation);
            $user=$this->getUser();
            $evaluation->setIdUtilisateur($user);
            $evaluation->setIdProduit($produit);
            $evaluation->setAppreciate(2);
            $em->flush();


        }
        else
        {
            $evaluation->setAppreciate(2);
            $em->flush();



        }

        return $this->redirectToRoute('afficher_Produit', array('id' => $produit->getIdProduit()));
    }



/*
    public function nombreAction(){

        $em = $this->getDoctrine()->getManager();

        $evaluation= $em->getRepository('ProduitBundle:Evaluation')->findBy(['appreciate'=> 1]);
        $nbevaluation=count($evaluation);


        return $this->redirectToRoute('afficher_Produit', array('nb'=>$nbevaluation));

    }*/


    public function supcommAction(Request $request,$id,$idp)

    {

        $id = $request->get('id');
        $idp=$request->get('idp');

        $em = $this->getDoctrine()->getManager();
        $commentaire = $em->getRepository('ProduitBundle:Commentaire')->find($id);
        $produit = $em->getRepository('ProduitBundle:Produit')->find($idp);


        $em->remove($commentaire);
        $em->flush();



        return $this->redirectToRoute('afficher_Produit', array('id'=>$idp));    }

    public function attenteAction()
    {
        return $this->render('ProduitBundle:Produit:attenteadmine.html.twig');
    }


}
