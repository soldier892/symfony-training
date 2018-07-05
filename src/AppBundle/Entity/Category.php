<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CategoryRepository")
 */
class Category
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
     * @ORM\Column(name="name", type="string", length=50)
     */

    private $name;

    /**
     * @var int
     * @ORM\OneToMany(targetEntity="Product", mappedBy="category")
     */

    private $products;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

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
     * Set Category Name
     * @param $name
     */

    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get Category Name
     * @return string
     */

    public function getName()
    {
        return $this->name;
    }

//    public function __toString()
//    {
//        // TODO: Implement __toString() method.
//        return $this->name;
//    }

    public function __get($name)
    {
        // TODO: Implement __get() method.
        return $this->name;
    }
}
