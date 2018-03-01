<?php

namespace MagasinBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Note
 *
 * @ORM\Table(name="note")
 * @ORM\Entity()
 */
class Note
{

    /**
     * @var
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\Id
     * @ORM\JoinColumn(name="idUser",referencedColumnName="id")
     */
    private $idUser;

    /**
     * @var
     *
     * @ORM\ManyToOne(targetEntity="MagasinBundle\Entity\Magasin")
     * @ORM\Id
     * @ORM\JoinColumn(name="id_magasin",referencedColumnName="id_magasin")
     */
    private $idMagasin;

    /**
     * @var float
     *
     * @ORM\Column(name="note", type="float", nullable=true)
     */
    private $note;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateNote", type="date", nullable=true)
     */
    private $dateNote;


    /**
     * Set note
     *
     * @param float $note
     *
     * @return Note
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return float
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set dateNote
     *
     * @param \DateTime $dateNote
     *
     * @return Note
     */
    public function setDateNote($dateNote)
    {
        $this->dateNote = $dateNote;

        return $this;
    }

    /**
     * Get dateNote
     *
     * @return \DateTime
     */
    public function getDateNote()
    {
        return $this->dateNote;
    }

    /**
     * Set idUser
     *
     * @param \UserBundle\Entity\User $idUser
     *
     * @return Note
     */
    public function setIdUser(\UserBundle\Entity\User $idUser)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get idUser
     *
     * @return \UserBundle\Entity\User
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set idMagasin
     *
     * @param \MagasinBundle\Entity\Magasin $idMagasin
     *
     * @return Note
     */
    public function setIdMagasin(\MagasinBundle\Entity\Magasin $idMagasin)
    {
        $this->idMagasin = $idMagasin;

        return $this;
    }

    /**
     * Get idMagasin
     *
     * @return \MagasinBundle\Entity\Magasin
     */
    public function getIdMagasin()
    {
        return $this->idMagasin;
    }
}
