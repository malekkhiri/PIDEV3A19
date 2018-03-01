<?php

namespace ProduitBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Evaluation
 *
 * @ORM\Table(name="evaluation")
 * @ORM\Entity(repositoryClass="ProduitBundle\Repository\EvaluationRepository")
 */
class Evaluation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @var int
     *
     * @ORM\Column(name="appreciate", type="integer", nullable=true)
     */
    private $appreciate;

    /**
     * @return mixed
     */
    public function getAppreciate()
    {
        return $this->appreciate;
    }

    /**
     * @param mixed $appreciate
     */
    public function setAppreciate($appreciate)
    {
        $this->appreciate = $appreciate;
    }

    /**
     * @return mixed
     */
    public function getIdProduit()
    {
        return $this->id_produit;
    }

    /**
     * @param mixed $id_produit
     */
    public function setIdProduit($id_produit)
    {
        $this->id_produit = $id_produit;
    }

    /**
     * @return mixed
     */
    public function getIdUtilisateur()
    {
        return $this->id_utilisateur;
    }

    /**
     * @param mixed $id_utilisateur
     */
    public function setIdUtilisateur($id_utilisateur)
    {
        $this->id_utilisateur = $id_utilisateur;
    }
    /**
     * @var
     * @ORM\ManyToOne(targetEntity="Produit")
     * @ORM\JoinColumn(name="id_produit",referencedColumnName="id_Produit")
     */
    public $id_produit;

    /**
     * @var
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(name="id_utilisateur",referencedColumnName="id")
     */
    private $id_utilisateur;
}

