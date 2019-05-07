<?php

namespace FoodCorner\CommandeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commande
 *
 * @ORM\Table(name="commande")
 * @ORM\Entity(repositoryClass="FoodCorner\CommandeBundle\Repository\CommandeRepository")
 */
class Commande
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
     * @var \DateTime
     * @ORM\Column(name="dateCommande", type="datetime")
     */

    private $dateCommande;


    /**
     * @var string
     * @ORM\Column(name="adresse", type="string")
     */
    private $adresse;


    /**
     * @var int
     * @ORM\Column(name="quantite", type="integer")
     */

    private $quantite;


//    /**
//     * @var int
//     * @ORM\Column(name="montant", type="integer")
//     */
//
//    private $montant;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User" , inversedBy="commande")
     * @ORM\JoinColumn(name="id_user" , referencedColumnName="id" )
     */

    private $user;


    /**
     * @ORM\ManyToOne(targetEntity="FoodCorner\MenuuBundle\Entity\Plat" , inversedBy="commande")
     * @ORM\JoinColumn(name="id_plat" , referencedColumnName="id" )
     */

    private $plat;


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
     * Set quantite
     *
     * @param integer $quantite
     *
     * @return Commande
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * Get quantite
     *
     * @return integer
     */
    public function getQuantite()
    {
        return $this->quantite;
    }


    /**
     * Set dateCommande
     *
     * @param \DateTime $dateCommande
     *
     * @return Commande
     */
    public function setDateCommande($dateCommande)
    {
        $this->dateCommande = $dateCommande;

        return $this;
    }

    /**
     * Get dateCommande
     *
     * @return \DateTime
     */
    public function getDateCommande()
    {
        return $this->dateCommande;
    }


    /**
     * Set adresse
     *
     * @param string $adresse
     * @return Commande
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }


    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Commande
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
     * Set plat
     *
     * @param \FoodCorner\MenuuBundle\Entity\Plat $plat
     *
     * @return Commande
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
