<?php

namespace FoodCorner\MenuuBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Plat
 *
 * @ORM\Table(name="plat")
 * @ORM\Entity(repositoryClass="FoodCorner\MenuuBundle\Repository\PlatRepository")
 */
class Plat
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
     * @ORM\OneToMany(targetEntity="FoodCorner\MenuuBundle\Entity\Offre" , mappedBy="Plat")
     */

    private $offre;


    /**
     * @var
     * @ORM\OneToMany(targetEntity="FoodCorner\CommandeBundle\Entity\Commande" , mappedBy="plat")
     */

    private $commande;


    /**
     * @ORM\ManyToOne(targetEntity="FoodCorner\MenuuBundle\Entity\Menu" , inversedBy="plat")
     * @ORM\JoinColumn(name="id_menu" , referencedColumnName="id" )
     */

    private $menu;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float")
     */
    private $prix;

    /**
     * @var int
     *
     * @ORM\Column(name="qte", type="integer")
     */
    private $qte;



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
     * Set name
     *
     * @param string $name
     *
     * @return Plat
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Plat
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
     * Set type
     *
     * @param string $type
     *
     * @return Plat
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
     * Set prix
     *
     * @param float $prix
     *
     * @return Plat
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return float
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set qte
     *
     * @param integer $qte
     *
     * @return Plat
     */
    public function setQte($qte)
    {
        $this->qte = $qte;

        return $this;
    }

    /**
     * Get qte
     *
     * @return int
     */
    public function getQte()
    {
        return $this->qte;
    }





    /**
     * @var string
     * @Assert\NotBlank(message=" please enter an image")
     * @Assert\Image()
     * @ORM\Column (name="image", type="string",length=255,nullable=true)
     */

    public $image;

    /**
     * @var boolean
     *
     * @ORM\Column(name="disponible", type="boolean")
     */
    private $disponible;




    /**
     * Set image
     *
     * @param string $image
     *
     * @return Plat
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    public function getFullPicturePath() {
        return null === $this->image ? null : $this->getUploadRootDir() . $this->image;
    }

    protected function getUploadRootDir() {
        // the absolute directory path where uploaded documents should be saved
        return __DIR__ . '/../../../../web/uploads/images/';
    }

    protected function getTmpUploadRootDir() {
        // the absolute directory path where uploaded documents should be saved
        return __DIR__ . '/../../../../web/uploads/images/';
    }

    public function uploadPicture() {
        // the file property can be empty if the field is not required
        if (null === $this->image) {
            return;
        }
        if (!$this->id) {
            $this->image->move($this->getTmpUploadRootDir(), $this->image->getClientOriginalName());
        } else {
            $this->image->move($this->getUploadRootDir(), $this->image->getClientOriginalName());
        }
        $this->setImage($this->image->getClientOriginalName());
    }

    /**
     * @ORM\PostPersist()
     */
    public function movePicture() {
        if (null === $this->image) {
            return;
        }
        if (!is_dir($this->getUploadRootDir())) {
            mkdir($this->getUploadRootDir());
        }
        copy($this->getTmpUploadRootDir() . $this->image, $this->getFullPicturePath());
        unlink($this->getTmpUploadRootDir() . $this->image);
    }

    /**
     * @ORM\PreRemove()
     */
    public function removePicture() {
        unlink($this->getFullPicturePath());
    }




    /**
     * Set disponible
     *
     * @param boolean $disponible
     *
     * @return Plat
     */
    public function setDisponible($disponible)
    {
        $this->disponible = $disponible;

        return $this;
    }

    /**
     * Get disponible
     *
     * @return boolean
     */
    public function getDisponible()
    {
        return $this->disponible;
    }



    /**
     * Set menu
     *
     * @param \FoodCorner\MenuuBundle\Entity\Menu $menu
     *
     * @return Plat
     */
    public function setMenu(\FoodCorner\MenuuBundle\Entity\Menu $menu = null)
    {
        $this->menu = $menu;

        return $this;
    }

    /**
     * Get menu
     *
     * @return \FoodCorner\MenuuBundle\Entity\Menu
     */
    public function getMenu()
    {
        return $this->menu;
    }

    /**
     * Add offre
     *
     * @param \FoodCorner\MenuuBundle\Entity\Offre $offre
     *
     * @return Plat
     */
    public function addOffre(\FoodCorner\MenuuBundle\Entity\Offre $offre)
    {
        $this->offre[] = $offre;

        return $this;
    }

    /**
     * Remove offre
     *
     * @param \FoodCorner\MenuuBundle\Entity\Offre $offre
     */
    public function removeOffre(\FoodCorner\MenuuBundle\Entity\Offre $offre)
    {
        $this->offre->removeElement($offre);
    }

    /**
     * Get offre
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOffre()
    {
        return $this->offre;
    }



    /**
     * Set menu
     *
     * @param \FoodCorner\MenuuBundle\Entity\Offre $offre
     *
     * @return Plat
     */
    public function setOffre(\FoodCorner\MenuuBundle\Entity\Offre $offre = null)
    {
        $this->offre = $offre;

        return $this;
    }






    /**
     * Constructor
     */
    public function __construct()
    {
        $this->offre = new \Doctrine\Common\Collections\ArrayCollection();
        $this->commande = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add commande
     *
     * @param \FoodCorner\CommandeBundle\Entity\Commande $commande
     *
     * @return Plat
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
     * Set menu
     *
     * @param \FoodCorner\CommandeBundle\Entity\Commande $commande
     *
     * @return Plat
     */
    public function setCommande(\FoodCorner\CommandeBundle\Entity\Commande $commande = null)
    {
        $this->offre = $commande;

        return $this;
    }

}
