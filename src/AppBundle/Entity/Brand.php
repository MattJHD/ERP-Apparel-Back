<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Description of Article
 *
 * @author wbloch
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BrandRepository")
 * @ORM\Table(name="apparel_brand")
 */
class Brand {
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


    //GETTER
    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }



    //SETTER
    function setId($id) {
        $this->id = $id;
    }

    function setName($name) {
        $this->name = $name;
    }




//    /**
//     * Constructor
//     */
//    public function __construct()
//    {
//        $this->articles = new \Doctrine\Common\Collections\ArrayCollection();
//    }
//
//    /**
//     * Add articles
//     *
//     * @param \AppBundle\Entity\Article $articles
//     * @return Brand
//     */
//    public function addArticle(\AppBundle\Entity\Article $articles)
//    {
//        $this->articles[] = $articles;
//
//        return $this;
//    }
//
//    /**
//     * Remove articles
//     *
//     * @param \AppBundle\Entity\Article $articles
//     */
//    public function removeArticle(\AppBundle\Entity\Article $articles)
//    {
//        $this->articles->removeElement($articles);
//    }
}
