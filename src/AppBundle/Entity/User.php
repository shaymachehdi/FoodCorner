<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom ;
    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     */

    private $prenom;

    /**
     * @var int
     *
     * @ORM\Column(name="tel", type="integer")
     */
    private $tel;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255)
     */

    private $adresse;


    /**
     * @var
     * @ORM\OneToMany(targetEntity="FoodCorner\CommandeBundle\Entity\Commande" , mappedBy="user")
     */

    private $commande;


    /**
     * @var
     * @ORM\OneToMany(targetEntity="FoodCorner\ReservationnBundle\Entity\Reservation" , mappedBy="user")
     */
    private $reservation;



    public function __construct()
    {
        parent::__construct();
        // your own logic


    }



    /**
     * Add reservation
     *
     * @param \FoodCorner\ReservationnBundle\Entity\Reservation $reservation
     *
     * @return User
     */
    public function addReservation(\FoodCorner\ReservationnBundle\Entity\Reservation $reservation)
    {
        $this->reservation[] = $reservation;

        return $this;
    }

    /**
     * Remove reservation
     *
     * @param \FoodCorner\ReservationnBundle\Entity\Reservation $reservation
     */
    public function removeReservation(\FoodCorner\ReservationnBundle\Entity\Reservation $reservation)
    {
        $this->reservation->removeElement($reservation);
    }

    /**
     * Get reservation
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReservation()
    {
        return $this->reservation;
    }


    /**
     * Add commande
     *
     * @param \FoodCorner\CommandeBundle\Entity\Commande $commande
     *
     * @return User
     */
    public function addCommande(\FoodCorner\CommandeBundle\Entity\Commande $commande)
    {
        $this->commande[] = $commande;

        return $this;
    }

    /**
     * Remove commande
     *
     * @param \FoodCorner\CommandeBundle\Entity\Commande $commande
     */
    public function removeCommande(\FoodCorner\CommandeBundle\Entity\Commande $commande)
    {
        $this->commande->removeElement($commande);
    }

    /**
     * Get commande
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCommande()
    {
        return $this->commande;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return User
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return User
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set tel
     *
     * @param integer $tel
     *
     * @return User
     */
    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get tel
     *
     * @return integer
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return User
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
     * Set commande
     *
     * @param \FoodCorner\CommandeBundle\Entity\Commande $commande
     *
     * @return User
     */
    public function setCommande(\FoodCorner\CommandeBundle\Entity\Commande $commande = null)
    {
        $this->commande = $commande;

        return $this;
    }
}
