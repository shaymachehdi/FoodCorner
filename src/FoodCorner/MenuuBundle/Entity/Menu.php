<?php

namespace FoodCorner\MenuuBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\Tests\StringableObject;

/**
 * Menu
 *
 * @ORM\Table(name="menu")
 * @ORM\Entity(repositoryClass="FoodCorner\MenuuBundle\Repository\MenuRepository")
 */
class Menu
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
     * @var
     * @ORM\OneToMany(targetEntity="FoodCorner\MenuuBundle\Entity\Plat" , mappedBy="menu")
     */

    private $plat;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;


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
     * Set type
     *
     * @param string $type
     *
     * @return Menu
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
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->plat = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString()
    {
        return (string) $this->type;
    }

    /**
     * Add plat
     *
     * @param \FoodCorner\MenuuBundle\Entity\Plat $plat
     *
     * @return Menu
     */
    public function addPlat(\FoodCorner\MenuuBundle\Entity\Plat $plat)
    {
        $this->plat[] = $plat;

        return $this;
    }

    /**
     * Remove plat
     *
     * @param \FoodCorner\MenuuBundle\Entity\Plat $plat
     */
    public function removePlat(\FoodCorner\MenuuBundle\Entity\Plat $plat)
    {
        $this->plat->removeElement($plat);
    }

    /**
     * Get plat
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlat()
    {
        return $this->plat;
    }



    /**
     * Set plat
     *
     * @param \FoodCorner\MenuuBundle\Entity\Plat $plat
     *
     * @return Menu
     */
    public function setPlat(\FoodCorner\MenuuBundle\Entity\Plat $plat = null)
    {
        $this->plat = $plat;

        return $this;
    }
}
