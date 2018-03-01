<?php

namespace CommandeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commande
 *
 * @ORM\Table(name="commande")
 * @ORM\Entity(repositoryClass="CommandeBundle\Repository\CommandeRepository")
 */
class Commande
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
     * @ORM\ManyToOne(targetEntity="ProduitBundle\Entity\Produit", inversedBy="Commande")
     * @ORM\JoinColumn(name="id_Produit",referencedColumnName="id_Produit")
     */
    public $id_Produit;

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
     * @var
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(name="id_utilisateur",referencedColumnName="id")
     */
    private $id_utilisateur;

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
     * Set idProduit
     *
     * @param \ProduitBundle\Entity\Produit $idProduit
     *
     * @return Commande
     */
    public function setIdProduit(\ProduitBundle\Entity\Produit $idProduit = null)
    {
        $this->id_Produit = $idProduit;

        return $this;
    }

    /**
     * Get idProduit
     *
     * @return \ProduitBundle\Entity\Produit
     */
    public function getIdProduit()
    {
        return $this->id_Produit;
    }


}
