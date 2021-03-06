<?php

namespace ProduitBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;



/**
 * Produit
 *
 * @ORM\Table(name="produit")
 * @ORM\Entity(repositoryClass="ProduitBundle\Repository\ProduitRepository")
 */
class Produit
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_Produit", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    private $id_Produit;
    /**
     * @var
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(name="id_utilisateur",referencedColumnName="id")
     */
    private $id_utilisateur;

    /**
     * @var
     * @ORM\ManyToOne(targetEntity="MagasinBundle\Entity\Magasin")
     * @ORM\JoinColumn(name="id_magasin",referencedColumnName="id_magasin")
     */
    private $id_magasin;

    /**
     * @return mixed
     */
    public function getIdMagasin()
    {
        return $this->id_magasin;
    }

    /**
     * @param mixed $id_magasin
     */
    public function setIdMagasin($id_magasin)
    {
        $this->id_magasin = $id_magasin;
    }


    /**
     * @ORM\Column(type="integer",options={"default" : 0},nullable=true)
     */
    protected $Validated ;

    /**
     * @return mixed
     */
    public function getValidated()
    {
        return $this->Validated;
    }

    /**
     * @param mixed $Validated
     */
    public function setValidated($Validated)
    {
        $this->Validated = $Validated;
    }

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
     * @var string
     *
     * @ORM\Column(name="Nom_Produit", type="string", length=255)
     */
    private $nomProduit;

    /**
     * @var float
     *
     * @ORM\Column(name="Prix", type="float")
     */
    private $prix;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="string", length=255)
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="Quantite", type="integer")
     */
    private $quantite;










    /**
     * @return int
     */

    public function getIdProduit()
    {
        return $this->id_Produit;
    }






    /**
     * Set nomProduit
     *
     * @param string $nomProduit
     *
     * @return Produit
     */
    public function setNomProduit($nomProduit)
    {
        $this->nomProduit = $nomProduit;

        return $this;
    }

    /**
     * Get nomProduit
     *
     * @return string
     */
    public function getNomProduit()
    {
        return $this->nomProduit;
    }

    /**
     * Set prix
     *
     * @param float $prix
     *
     * @return Produit
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return float
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Produit
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set quantite
     *
     * @param integer $quantite
     *
     * @return Produit
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * Get quantite
     *
     * @return int
     */
    public function getQuantite()
    {
        return $this->quantite;
    }


// ...

    /**
     * @ORM\Column(type="string")
     *
     * @Assert\NotBlank(message="Please, upload the product brochure as a PDF file.")
     * @Assert\File(mimeTypes={ "image/jpeg" })
     */
    private $brochure;

    public function getBrochure()
    {
        return $this->brochure;
    }

    public function setBrochure($brochure)
    {
        $this->brochure = $brochure;

        return $this;
    }

    /**
     * @ORM\OneToMany(targetEntity="CommandeBundle\Entity\Commande", mappedBy="Produit")
     */
    public $idcommande;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idcommande = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add idcommande
     *
     * @param \CommandeBundle\Entity\Commande $idcommande
     *
     * @return Produit
     */
    public function addIdcommande(\CommandeBundle\Entity\Commande $idcommande)
    {
        $this->idcommande[] = $idcommande;

        return $this;
    }

    /**
     * Remove idcommande
     *
     * @param \CommandeBundle\Entity\Commande $idcommande
     */
    public function removeIdcommande(\CommandeBundle\Entity\Commande $idcommande)
    {
        $this->idcommande->removeElement($idcommande);
    }

    /**
     * Get idcommande
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdcommande()
    {
        return $this->idcommande;
    }


}

