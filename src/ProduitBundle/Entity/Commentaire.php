<?php

namespace ProduitBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commentair
 *
 * @ORM\Table(name="commentaire")
 * @ORM\Entity(repositoryClass="ProduitBundle\Repository\CommentaireRepository")
 */
class Commentaire
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
     * @var string
     *
     * @ORM\Column(name="Contenu", type="string", length=255)
     */
    private $contenu;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creationDate", type="datetime")
     */
    private $creationDate;

    /**

     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", cascade={"persist"})

     * @ORM\JoinColumn(nullable=false)

     */
    protected $commentator;





    /**

     * @ORM\ManyToOne(targetEntity="ProduitBundle\Entity\Produit", cascade={"persist"})

     * @ORM\JoinColumn(name="commentedproduct",referencedColumnName="id_Produit",onDelete="CASCADE")

     */

    protected $commentedproduct;


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
     * Set contenu
     *
     * @param string $contenu
     *
     * @return Commentaire
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
     * Set creationDate
     *
     * @param \DateTime $creationDate
     *
     * @return Commentaire
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * Get creationDate
     *
     * @return \DateTime
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * @return mixed
     */
    public function getCommentator()
    {
        return $this->commentator;
    }

    /**
     * @param mixed $commentator
     */
    public function setCommentator($commentator)
    {
        $this->commentator = $commentator;
    }

    /**
     * @return mixed
     */
    public function getCommentedproduct()
    {
        return $this->commentedproduct;
    }

    /**
     * @param mixed $commentedproduct
     */
    public function setCommentedproduct($commentedproduct)
    {
        $this->commentedproduct = $commentedproduct;
    }


}