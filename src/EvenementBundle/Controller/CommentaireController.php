<?php

namespace EvenementBundle\Controller;


use EvenementBundle\Entity\Commentaire;
use EvenementBundle\Entity\Evenement;
use EvenementBundle\Form\CommentaireType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CommentaireController extends Controller
{
    public function CommentAction(Request $request, Evenement $event)
    {

        $commentaire = new Commentaire();
        $Form = $this->createForm(CommentaireType::class, $commentaire);
        $Form->handleRequest($request);
        if ($Form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $user=$this->getUser();
            if (!$user=$this->getUser()){

                return $this->redirectToRoute('fos_user_security_login');

            }
            else{
            $commentaire->setCommentator($user);
            $date = new \DateTime();
            $commentaire->setCreationDate($date);
            $commentaire->setCommented($event);
            $em->persist($commentaire);
            $em->flush();
            }
//            return $this->redirectToRoute('_affiche2');
            $Form = $this->createForm(CommentaireType::class, $commentaire);

            return $this->render('EvenementBundle:Evenement:ajoutCommentaire.html.twig', array(// ...
                'form' => $Form->createView()
            ));
        }
        return $this->render('EvenementBundle:Evenement:ajoutCommentaire.html.twig', array(// ...
            'form' => $Form->createView()
        ));
    }
    public function AfficheCommentaireAction(Request $request,$id_Evenement)

    {

        $em = $this->getDoctrine()->getManager();
        $event=$em->getRepository("EvenementBundle:Evenement")->find($id_Evenement);
        $commentaires = $em->getRepository("EvenementBundle:Commentaire")->findBy(['commented'=>$id_Evenement]);
        $commentaire = new Commentaire();
        $Form = $this->createForm(CommentaireType::class, $commentaire);
        $Form->handleRequest($request);
        if ($Form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $user=$this->getUser();
            if (!$user=$this->getUser()){

                return $this->redirectToRoute('fos_user_security_login');

            }
            else{
                $commentaire->setCommentator($user);
                $date = new \DateTime();
                $commentaire->setCreationDate($date);
                $commentaire->setCommented($event);
                $em->persist($commentaire);
                $em->flush();
                unset($Form);
                $commentaires = $em->getRepository("EvenementBundle:Commentaire")->findBy(['commented'=>$id_Evenement]);

            }
//            return $this->redirectToRoute('_affiche2');
            $Form = $this->createForm(CommentaireType::class, $commentaire);

            return $this->render('EvenementBundle:Commentaire:commentaire.html.twig', array(// ...
                'form' => $Form->createView(),
                'c' => $commentaires,
            ));
        }


        return $this->render('EvenementBundle:Commentaire:commentaire.html.twig',
            array(
                'c' => $commentaires,
                'form' => $Form->createView()

            ));
    }
}
