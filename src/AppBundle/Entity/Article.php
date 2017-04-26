<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Description of Article
 *
 * @author wbloch
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ArticleRepository")
 * @ORM\Table(name="Apparel_Article")
 */
class Article {
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\Column(type="string")
     */
    private $size;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="articles")
     */
    private $category;

    /**
     * @ORM\ManyToMany(targetEntity="Material", inversedBy="articles")
     */
    private $materials;

     /**
     * @ORM\Column(type="string")
     * @ORM\ManyToMany(targetEntity="Color", inversedBy="articles")
     */
    private $colors;

    /**
     * @ORM\ManyToOne(targetEntity="Brand", inversedBy="articles")
     */
    private $brand;
    
    /**
     * @ORM\OneToOne(targetEntity="Shop", inversedBy="articles")
     */
    private $shop;

    /**
     * @ORM\Column(type="boolean")
     */
    private $solded = false;
    
    /**
     * @ORM\Column(type="string")
     */
    private $soldBy;
    
    /**
     * @ORM\Column(type="datetime")
     */
    private $soldAt;
    

    //GETTERS
    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getPrice() {
        return $this->price;
    }

    function getSize() {
        return $this->size;
    }

    function getCategory() {
        return $this->category;
    }

    function getMaterials() {
        return $this->materials;
    }

    function getColors() {
        return $this->colors;
    }

    function getBrand() {
        return $this->brand;
    }

    function getShop() {
        return $this->shop;
    }

    function getSolded() {
        return $this->solded;
    }

    function getSoldBy() {
        return $this->soldBy;
    }

    function getSoldAt() {
        return $this->soldAt;
    }

        
    //SETTERS
    function setId($id) {
        $this->id = $id;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setPrice($price) {
        $this->price = $price;
    }

    function setSize($size) {
        $this->size = $size;
    }

    function setCategory($category) {
        $this->category = $category;
    }

    function setMaterials($materials) {
        $this->materials = $materials;
    }

    function setColors($colors) {
        $this->colors = $colors;
    }

    function setBrand($brand) {
        $this->brand = $brand;
    }

    function setShop($shop) {
        $this->shop = $shop;
    }
    
    function setSolded($solded) {
        $this->solded = $solded;
    }

    function setSoldBy($soldBy) {
        $this->soldBy = $soldBy;
    }

    function setSoldAt($soldAt) {
        $this->soldAt = $soldAt;
    }






    /**
     * Constructor
     */
    public function __construct()
    {
        $this->materials = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add materials
     *
     * @param \AppBundle\Entity\Material $materials
     * @return Article
     */
    public function addMaterial(\AppBundle\Entity\Material $materials)
    {
        $this->materials[] = $materials;

        return $this;
    }

    /**
     * Remove materials
     *
     * @param \AppBundle\Entity\Material $materials
     */
    public function removeMaterial(\AppBundle\Entity\Material $materials)
    {
        $this->materials->removeElement($materials);
    }
}