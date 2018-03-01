<?php

namespace ReclamationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\Component\Pager\Paginator;

/**
 * Reclamation
 *
 * @ORM\Table(name="reclamation")
 * @ORM\Entity(repositoryClass="ReclamationBundle\Repository\ReclamationRepository")
 */
class Reclamation
{
    /**
     * @var int
     *
     * @ORM\Column(name="idReclamation", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    private $idReclamation;

    /**
     * @var
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(name="NomDestinataire",referencedColumnName="id")
     */
    private $nomDestinataire;

    /**
     * @var string
     *
     *  /**
     * @var
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(name="emetteur",referencedColumnName="id")
     */

    private $emetteur;

    /**
     * @var string
     *
     * @ORM\Column(name="Contenu", type="string", length=255)
     */
    private $contenu;

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime" , nullable=true)
     */
    private $date;




    /**
     * Set nomDestinataire
     *
     * @param string $nomDestinataire
     *
     * @return Reclamation
     */
    public function setNomDestinataire($nomDestinataire)
    {
        $this->nomDestinataire = $nomDestinataire;

        return $this;
    }

    /**
     * Get nomDestinataire
     *
     * @return string
     */
    public function getNomDestinataire()
    {
        return $this->nomDestinataire;
    }

    /**
     * Set emetteur
     *
     * @param string $emetteur
     *
     * @return Reclamation
     */
    public function setEmetteur($emetteur)
    {
        $this->emetteur = $emetteur;

        return $this;
    }

    /**
     * Get emetteur
     *
     * @return string
     */
    public function getEmetteur()
    {
        return $this->emetteur;
    }

    /**
     * Set contenu
     *
     * @param string $contenu
     *
     * @return Reclamation
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Get idReclamation
     *
     * @return integer
     */
    public function getIdReclamation()
    {
        return $this->idReclamation;
    }

    /**
     * Get the paginated list of reclamation
     *
     * @param int $page
     * @param int $maxperpage
     * @param string $sortby
     * @return Paginator
     */
    public function getList($page=1, $maxperpage=10)
    {
        $q = $this->_em->createQueryBuilder()
            ->select('reclamation')
            ->from('ReclamationBundle:Reclamation','reclamation')
        ;

        $q->setFirstResult(($page-1) * $maxperpage)
            ->setMaxResults($maxperpage);

        return new Paginator($q);
    }
}
