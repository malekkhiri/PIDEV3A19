<?php

namespace EvenementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comment
 *
 * @ORM\Table(name="comment")
 * @ORM\Entity(repositoryClass="EvenementBundle\Repository\CommentRepository")
 */
class Comment
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
     * @ORM\Column(name="CreationDate", type="datetime")
     */
    private $creationDate;
    /**

     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", cascade={"persist"})

     * @ORM\JoinColumn(nullable=false)

     */
    protected $commentator;


    /**

     * @ORM\ManyToOne(targetEntity="EvenementBundle\Entity\Evenement")

     * @ORM\JoinColumn(name="commented" ,referencedColumnName="id")

     */

    protected $commented;

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
     * @return Comment
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
     * @return Comment
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
     * Set commentator
     *
     * @param \UserBundle\Entity\User $commentator
     *
     * @return Comment
     */
    public function setCommentator(\UserBundle\Entity\User $commentator)
    {
        $this->commentator = $commentator;

        return $this;
    }

    /**
     * Get commentator
     *
     * @return \UserBundle\Entity\User
     */
    public function getCommentator()
    {
        return $this->commentator;
    }

    /**
     * @param mixed $commented
     */
    public function setCommented($commented)
    {
        $this->commented = $commented;
    }


}

