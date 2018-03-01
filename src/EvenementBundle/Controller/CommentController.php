<?php

namespace EvenementBundle\Controller;


use EvenementBundle\Entity\Comment;
use EvenementBundle\Entity\Evenement;
use EvenementBundle\Form\CommentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CommentController extends Controller
{
    public function CommentAction(Request $request, Evenement $event)
    {

        $commentaire = new Comment();
        $Form = $this->createForm(CommentType::class, $commentaire);
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
            $Form = $this->createForm(CommentType::class, $commentaire);

            return $this->render('EvenementBundle:Evenement:ajoutCommentaire.html.twig', array(// ...
                'form' => $Form->createView()
            ));
        }
        return $this->render('EvenementBundle:Evenement:ajoutCommentaire.html.twig', array(// ...
            'form' => $Form->createView()
        ));
    }
    public function AfficheCommentaireAction(Request $request,$id)

    {

        $em = $this->getDoctrine()->getManager();
        $event=$em->getRepository("EvenementBundle:Evenement")->find($id);
        $commentaires = $em->getRepository("EvenementBundle:Comment")->findBy(['commented'=>$id]);
        $commentaire = new Comment();
        $Form = $this->createForm(CommentType::class, $commentaire);
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
                $commentaires = $em->getRepository("EvenementBundle:Comment")->findBy(['commented'=>$id]);

            }
//            return $this->redirectToRoute('_affiche2');
            $Form = $this->createForm(CommentType::class, $commentaire);

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
