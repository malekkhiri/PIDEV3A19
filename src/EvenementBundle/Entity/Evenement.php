<?php

namespace EvenementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Evenement
 *
 * @ORM\Table(name="evenement")
 * @ORM\Entity(repositoryClass="EvenementBundle\Repository\EvenementRepository")
 */
class Evenement
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
     * @var \DateTime
     *
     * @ORM\Column(name="Date_Debut", type="date")
     */

    private $dateDebut;

    /**
     * @return \DateTime
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * @param \DateTime $dateDebut
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;
    }

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date_Fin", type="date")
     */
    private $dateFin;

    /**
     * @var string
     *
     * @ORM\Column(name="Nom_Evenement", type="string", length=255)
     */
    private $nomEvenement;

    /**
     * @var string
     *
     * @ORM\Column(name="Lieux", type="string", length=255)
     */
    private $lieux;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="string", length=255)
     */
    private $description;



    /**

     * @ORM\ManyToMany(targetEntity="UserBundle\Entity\User")

     * @ORM\JoinColumn(name="usersParticipate" ,referencedColumnName="id")

     */

    protected $usersParticipate;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbParticipe", type="integer",options={"default"= 0},nullable=true)
     */
    private $nbParticipe;

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     *
     * @return Evenement
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * Set nomEvenement
     *
     * @param string $nomEvenement
     *
     * @return Evenement
     */
    public function setNomEvenement($nomEvenement)
    {
        $this->nomEvenement = $nomEvenement;

        return $this;
    }

    /**
     * Get nomEvenement
     *
     * @return string
     */
    public function getNomEvenement()
    {
        return $this->nomEvenement;
    }

    /**
     * Set lieux
     *
     * @param string $lieux
     *
     * @return Evenement
     */
    public function setLieux($lieux)
    {
        $this->lieux = $lieux;

        return $this;
    }

    /**
     * Get lieux
     *
     * @return string
     */
    public function getLieux()
    {
        return $this->lieux;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Evenement
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
     * Constructor
     */
    public function __construct()
    {
        $this->usersParticipate = new \Doctrine\Common\Collections\ArrayCollection();
    }



    /**
     * Add usersParticipate
     *
     * @param \UserBundle\Entity\User $usersParticipate
     *
     * @return Evenement
     */
    public function addUsersParticipate(\UserBundle\Entity\User $usersParticipate)
    {
        $this->usersParticipate[] = $usersParticipate;

        return $this;
    }

    /**
     * Remove usersParticipate
     *
     * @param \UserBundle\Entity\User $usersParticipate
     */
    public function removeUsersParticipate(\UserBundle\Entity\User $usersParticipate)
    {
        $this->usersParticipate->removeElement($usersParticipate);
    }

    /**
     * Set usersParticipate
     * @param mixed $usersParticipate
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function setUsersParticipate($usersParticipate)
    {
        return $this->usersParticipate;
    }

    /**
     * Get usersParticipate
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsersParticipate()
    {
        return $this->usersParticipate;
    }

    /**
     * Set nbParticipe
     *
     * @param integer $nbParticipe
     *
     * @return Evenement
     */
    public function setNbParticipe($nbParticipe)
    {
        $this->nbParticipe = $nbParticipe;

        return $this;
    }

    /**
     * Get nbParticipe
     *
     * @return integer
     */
    public function getNbParticipe()
    {
        return $this->nbParticipe;
    }
}
