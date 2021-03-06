<?php

namespace FoodCorner\MenuuBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Offre
 *
 * @ORM\Table(name="offre")
 * @ORM\Entity(repositoryClass="FoodCorner\MenuuBundle\Repository\OffreRepository")
 */
class Offre
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
     * @ORM\Column(name="description", type="text")
     */

      private $description;

    /**
     * @ORM\ManyToOne(targetEntity="FoodCorner\MenuuBundle\Entity\Plat" , inversedBy="Plat")
     * @ORM\JoinColumn(name="id_plat" , referencedColumnName="id" )
     */

    private $plat;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datedeb", type="datetime")
     */
    private $datedeb;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datefin", type="datetime")
     */
    private $datefin;


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
     * Set description
     *
     * @param string $description
     *
     * @return Offre
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
     * Set datedeb
     *
     * @param \DateTime $datedeb
     *
     * @return Offre
     */
    public function setDatedeb($datedeb)
    {
        $this->datedeb = $datedeb;

        return $this;
    }

    /**
     * Get datedeb
     *
     * @return \DateTime
     */
    public function getDatedeb()
    {
        return $this->datedeb;
    }

    /**
     * Set datefin
     *
     * @param \DateTime $datefin
     *
     * @return Offre
     */
    public function setDatefin($datefin)
    {
        $this->datefin = $datefin;

        return $this;
    }

    /**
     * Get datefin
     *
     * @return \DateTime
     */
    public function getDatefin()
    {
        return $this->datefin;
    }






    /**
     * Add menu
     *
     * @param \FoodCorner\MenuuBundle\Entity\Plat $menu
     *
     * @return Offre
     */
    public function addMenu(\FoodCorner\MenuuBundle\Entity\Plat $menu)
    {
        $this->menu[] = $menu;

        return $this;
    }

    /**
     * Remove menu
     *
     * @param \FoodCorner\MenuuBundle\Entity\Plat $menu
     */
    public function removeMenu(\FoodCorner\MenuuBundle\Entity\Plat $menu)
    {
        $this->menu->removeElement($menu);
    }

    /**
     * Get menu
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMenu()
    {
        return $this->menu;
    }

    /**
     * Set plat
     *
     * @param \FoodCorner\MenuuBundle\Entity\Plat $plat
     *
     * @return Offre
     */
    public function setPlat(\FoodCorner\MenuuBundle\Entity\Plat $plat = null)
    {
        $this->plat = $plat;

        return $this;
    }

    /**
     * Get plat
     *
     * @return \FoodCorner\MenuuBundle\Entity\Plat
     */
    public function getPlat()
    {
        return $this->plat;
    }
}
