<?php

namespace MagasinBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Magasin
 *
 * @ORM\Table(name="magasin")
 * @ORM\Entity()
 */
class Magasin
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_magasin", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    private $id_magasin;





    /**
     * @var string
     *
     * @ORM\Column(name="nom_magasin", type="string", length=255)
     */
    private $nom_magasin;

    /**
     * @var
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(name="prop_magasin",referencedColumnName="id")
     */
    private $prop_magasin;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse_magasin", type="string", length=255)
     */
    private $adresse_magasin;

    /**
     * @var string
     *
     * @ORM\Column(name="region", type="string", length=255)
     */
    private $region;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=255)
     */
    private $ville;



    /**
     * Set idMagasin
     *
     * @param integer $idMagasin
     *
     * @return Magasin
     */
    public function setIdMagasin($idMagasin)
    {
        $this->id_magasin = $idMagasin;

        return $this;
    }

    /**
     * Get idMagasin
     *
     * @return integer
     */
    public function getIdMagasin()
    {
        return $this->id_magasin;
    }

    /**
     * Set nomMagasin
     *
     * @param string $nomMagasin
     *
     * @return Magasin
     */
    public function setNomMagasin($nomMagasin)
    {
        $this->nom_magasin = $nomMagasin;

        return $this;
    }

    /**
     * Get nomMagasin
     *
     * @return string
     */
    public function getNomMagasin()
    {
        return $this->nom_magasin;
    }

    /**
     * Set propMagasin
     *
     * @param string $propMagasin
     *
     * @return Magasin
     */
    public function setPropMagasin($propMagasin)
    {
        $this->prop_magasin = $propMagasin;

        return $this;
    }

    /**
     * Get propMagasin
     *
     * @return string
     */
    public function getPropMagasin()
    {
        return $this->prop_magasin;
    }

    /**
     * Set adresseMagasin
     *
     * @param string $adresseMagasin
     *
     * @return Magasin
     */
    public function setAdresseMagasin($adresseMagasin)
    {
        $this->adresse_magasin = $adresseMagasin;

        return $this;
    }

    /**
     * Get adresseMagasin
     *
     * @return string
     */
    public function getAdresseMagasin()
    {
        return $this->adresse_magasin;
    }

    /**
     * Set region
     *
     * @param string $region
     *
     * @return Magasin
     */
    public function setRegion($region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get region
     *
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return Magasin
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
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



}
