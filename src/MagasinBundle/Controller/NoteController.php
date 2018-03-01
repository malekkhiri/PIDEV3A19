<?php

namespace MagasinBundle\Controller;
use MagasinBundle\Entity\Magasin;
use MagasinBundle\Entity\Note;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class NoteController extends Controller
{
    public function CreateRatingAction(Request $request,$note,$id)
    {
        $notes=new Note();
        $em=$this->getDoctrine()->getManager();
        $magasin = $em->getRepository(Magasin::class)->find($id);
        $notes->setIdUser($this->getUser())
            ->setDateNote(new \DateTime())
            ->setIdMagasin($magasin)
            ->setNote($note);
        /* $noteT= new Note();
         $noteT = $em->getRepository(Note::class)->findNote($this->getUser(),$magasin);
         if($noteT == null)
             $em->persist($notes);
         else{
             $noteT->setNote($note);
             $notes=$noteT;

        }*/
        $em->persist($notes);

        $em->flush();
        return $this->redirectToRoute('_Affiche2Magasin',
            array(
                'm' => $magasin

            ));


    }
    public  function afficheRatingAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $magasin = $em->getRepository(Magasin::class)->find($id);
        return $this->render('MagasinBundle:Magasin:affichemagasin.html.twig',
            array(
                'magasin' => $magasin

            ));

    }

    public function AfficheNoteAction($id)
    {
        $em = $this->getDoctrine()->getManager();


        $note = $em->getRepository("MagasinBundle:Note")->findby(['idMagasin'=>$id]);
        return $this->render('MagasinBundle:Magasin:affichenote.html.twig',
            array(
                'n' => $note));
    }


}