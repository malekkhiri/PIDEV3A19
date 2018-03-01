<?php

namespace GrapheBundle\Controller;

use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use EvenementBundle\Entity\Evenement;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $pieChart = new PieChart();
        $em= $this->getDoctrine();
        $evenements = $em->getRepository(Evenement::class)->findAll();
        $totalParticipants=0;
        foreach($evenements as $classe) { $totalParticipants=$totalParticipants+$classe->getNbParticipe();
        }
        $data= array();
        $stat=['classe', 'nbEtudiant'];
        $nb=0;
        array_push($data,$stat);
        foreach($evenements as $classe)
        { $stat=array();
            array_push($stat,$classe->getNomEvenement(),(($classe->getNbParticipe()) *100)/$totalParticipants);
            $nb=($classe->getNbParticipe() *100)/$totalParticipants;
            $stat=[$classe->getNomEvenement(),$nb];
            array_push($data,$stat);
        }
        $pieChart->getData()->setArrayToDataTable( $data );
        $pieChart->getOptions()->setTitle('Pourcentages des participants par evenement');
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(900);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);
        return $this->render('GrapheBundle:Default:index.html.twig', array('piechart' => $pieChart));
    }
}
