<?php

namespace VenteLibreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Annonces
 *
 * @ORM\Table(name="annonces")
 * @ORM\Entity(repositoryClass="VenteLibreBundle\Repository\AnnoncesRepository")
 * @Vich\Uploadable
 */
class Annonces
{
    /**
     * @var int
     *
     * @ORM\Column(name="idVenteLibre", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idVenteLibre;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=255)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="region", type="string", length=255)
     */
    private $region;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="TelephoneVendeur", type="integer")
     */
    private $telephoneVendeur;
    /**
     * @var int
     *
     * @ORM\Column(name="prix", type="float")
     */
    private $prix;

    /**
     *@ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(referencedColumnName="id",name="user_id")
     */
    private $user;

    /**
     * @var int
     *
     * @ORM\Column(name="datepublication", type="string", nullable=true)
     */
    private $datepublication ;

    /**
     * @var int
     *
     * @ORM\Column(name="approuver", type="boolean")
     */
    private $approuver = 0;
    /**
     * Set approuver
     *
     * @param string $approuver
     *
     * @return Annonces
     */
    public function setApprouver($approuver)
    {
        $this->approuver = $approuver;

        return $this;
    }

    /**
     * Get approuver
     *
     * @return string
     */
    public function getApprouver()
    {
        return $this->approuver;
    }


    public function setDatepublication($datepublication)
    {
        $this->datepublication = $datepublication;

        return $this;
    }
    public function getDatepublication()
    {
        return $this->datepublication;
    }


    /**
     * Set prix
     *
     * @param string $prix
     *
     * @return Annonces
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return string
     */
    public function getPrix()
    {
        return $this->prix;
    }


    /**
     * Set titre
     *
     * @param string $titre
     *
     * @return Annonces
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }



    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return Annonces
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
     * Set region
     *
     * @param string $region
     *
     * @return Annonces
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
     * Set description
     *
     * @param string $description
     *
     * @return Annonces
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
     * Set user
     *
     * @param string $user
     *
     * @return Annonces
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set telephoneVendeur
     *
     * @param integer $telephoneVendeur
     *
     * @return Annonces
     */
    public function setTelephoneVendeur($telephoneVendeur)
    {
        $this->telephoneVendeur = $telephoneVendeur;

        return $this;
    }

    /**
     * Get telephoneVendeur
     *
     * @return int
     */
    public function getTelephoneVendeur()
    {
        return $this->telephoneVendeur;
    }

    /**
     * Get idVenteLibre
     *
     * @return integer
     */
    public function getIdVenteLibre()
    {
        return $this->idVenteLibre;
    }




    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="product_image", fileNameProperty="imageName")
     *
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string

     */
    private $imageName;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     *
     * @return Product
     */
    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        if ($image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }

        return $this;
    }


    /**
     * @return File|null
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * @param string $imageName
     *
     * @return Product
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getImageName()
    {
        return $this->imageName;
    }
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param mixed $Libelle
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }
}
