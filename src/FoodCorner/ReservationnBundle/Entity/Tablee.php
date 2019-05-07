<?php

namespace FoodCorner\ReservationnBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tablee
 *
 * @ORM\Table(name="tablee")
 * @ORM\Entity(repositoryClass="FoodCorner\ReservationnBundle\Repository\TableeRepository")
 */
class Tablee
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
     * @ORM\ManyToOne(targetEntity="FoodCorner\ReservationnBundle\Entity\Reservation", inversedBy="Reservation")
     * @ORM\JoinColumn(name="id_reserv" , referencedColumnName="id")
     */
    private $reserv;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}

