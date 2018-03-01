<?php

namespace MagasinBundle\Controller;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use MagasinBundle\Entity\Note;
use Ob\HighchartsBundle\Highcharts\Highchart;
use ProduitBundle\Entity\Produit;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GrapheController extends Controller
{
    public function GrapheAction()
    {

        $pieChart = new PieChart();
        $em = $this->getDoctrine();
        $produits = $em->getRepository(Produit::class)->findAll();
        $totalProduit = 0;
        foreach ($produits as $classe) {
            $totalProduit = $totalProduit + $classe->getQuantite();
        }
        $data = array();
        $stat = ['classe', 'nbEtudiant'];
        $nb = 0;
        array_push($data, $stat);
        foreach ($produits as $classe) {
            $stat = array();
            array_push($stat, $classe->getNomProduit(), (($classe->getQuantite()) * 100) / $totalProduit);
            $nb = ($classe->getQuantite() * 100) / $totalProduit;
            $stat = [$classe->getNomProduit(), $nb];
            array_push($data, $stat);
        }
        $pieChart->getData()->setArrayToDataTable($data);
        $pieChart->getOptions()->setTitle('Pourcentages des Produit ');
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(900);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);
        return $this->render('MagasinBundle:Graphe:pie.html.twig', array('piechart' => $pieChart));
    }


}