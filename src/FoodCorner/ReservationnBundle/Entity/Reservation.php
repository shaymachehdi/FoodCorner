<?php

namespace FoodCorner\ReservationnBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Reservation
 *
 * @ORM\Table(name="reservation")
 * @ORM\Entity(repositoryClass="FoodCorner\ReservationnBundle\Repository\ReservationRepository")
 */
class Reservation
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
     * @ORM\OneToMany(targetEntity="FoodCorner\ReservationnBundle\Entity\Tablee",mappedBy="Reservation")
     *
     */
    private $tablee;


    /**
     * @var \DateTime
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var int
     *
     * @ORM\Column(name="nbrepers", type="integer")
     */
    private $nbrepers;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string")
     */
    private $type;


    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User" , inversedBy="reservation")
     * @ORM\JoinColumn(name="id_user" , referencedColumnName="id" )
     */

    private $user;


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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Reservation
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set nbrepers
     *
     * @param integer $nbrepers
     *
     * @return Reservation
     */
    public function setNbrepers($nbrepers)
    {
        $this->nbrepers = $nbrepers;

        return $this;
    }

    /**
     * Get nbrepers
     *
     * @return int
     */
    public function getNbrepers()
    {
        return $this->nbrepers;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tablee = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add tablee
     *
     * @param \FoodCorner\ReservationnBundle\Entity\Tablee $tablee
     *
     * @return Reservation
     */
    public function addTablee(\FoodCorner\ReservationnBundle\Entity\Tablee $tablee)
    {
        $this->tablee[] = $tablee;

        return $this;
    }

    /**
     * Remove tablee
     *
     * @param \FoodCorner\ReservationnBundle\Entity\Tablee $tablee
     */
    public function removeTablee(\FoodCorner\ReservationnBundle\Entity\Tablee $tablee)
    {
        $this->tablee->removeElement($tablee);
    }

    /**
     * Get tablee
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTablee()
    {
        return $this->tablee;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Reservation
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }



    /**
     * Set type
     *
     * @param string $type
     *
     * @return Reservation
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
}
