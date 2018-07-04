<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Product
 * @package AppBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="product")
 */

class Product
{
    /**
     * @var $id
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var $name
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @var $price
     * @ORM\Column(type="decimal", scale=2)
     */
    private $price;

    /**
     * @var $description
     * @ORM\Column(type="text")
     */
    private $description;


    public function getName()
    {
        return $this->name;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }
}
