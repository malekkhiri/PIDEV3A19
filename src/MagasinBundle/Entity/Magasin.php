<?php

namespace MagasinBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Magasin
 *
 * @ORM\Table(name="magasin")
 * @ORM\Entity(repositoryClass="MagasinBundle\Repository\MagasinRepository")
 */
class Magasin
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_magasin", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id_magasin;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_magasin", type="string", length=255)
     */
    private $nomMagasin;

    /**
     * @var string
     *
     * @ORM\Column(name="prop_magasin", type="string", length=255)
     */
    private $propMagasin;

    /**
     * @var string
     *
     * @ORM\Column(name="addresse_magasin", type="string", length=255)
     */
    private $addresseMagasin;


    /**
     * Get id
     *
     * @return int
     */


    /**
     * Set nomMagasin
     *
     * @param string $nomMagasin
     *
     * @return Magasin
     */
    public function setNomMagasin($nomMagasin)
    {
        $this->nomMagasin = $nomMagasin;

        return $this;
    }

    /**
     * Get nomMagasin
     *
     * @return string
     */
    public function getNomMagasin()
    {
        return $this->nomMagasin;
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
        $this->propMagasin = $propMagasin;

        return $this;
    }

    /**
     * Get propMagasin
     *
     * @return string
     */
    public function getPropMagasin()
    {
        return $this->propMagasin;
    }

    /**
     * Set addresseMagasin
     *
     * @param string $addresseMagasin
     *
     * @return Magasin
     */
    public function setAddresseMagasin($addresseMagasin)
    {
        $this->addresseMagasin = $addresseMagasin;

        return $this;
    }

    /**
     * Get addresseMagasin
     *
     * @return string
     */
    public function getAddresseMagasin()
    {
        return $this->addresseMagasin;
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
}
