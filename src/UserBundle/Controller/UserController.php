<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class UserController extends Controller
{


    public function AfficheAction()
    {
        $em=$this->getDoctrine()->getManager();
        $user=$em->getRepository("UserBundle:User")->findAll();

        return $this->render('ProjetBundle:back:recherche.html.twig', array('u'=>$user
            // ...
        ));
    }

    public function supAction(Request $request,$id)

    {
        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('UserBundle:User')->find($id);


        $em->remove($user);
        $em->flush();



        return $this->redirectToRoute('rech',array());    }



}
