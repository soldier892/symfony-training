<?php
namespace AppBundle\Service;

use AppBundle\Entity\Product;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class Products
{
    public $entityManager;

    public function __construct(EntityManagerInterface $doctrine)
    {
        $this->entityManager = $doctrine;
    }

    public function createProduct($product)
    {
//        $entityManager = $this->getDoctrine()->getManager();

        $this->entityManager->persist($product);

        $this->entityManager->flush();

        return true;
    }


    public function showProduct()
    {
        return $this->entityManager->getRepository(Product::class)->findAll();
    }


    public function findProduct($key)
    {
        return $product = $this->entityManager->getRepository(Product::class)->find($key);
    }


    public function deleteProduct($key)
    {
        $product = $this->entityManager->getRepository(Product::class)->find($key);
        $this->entityManager->remove($product);
        $this->entityManager->flush();
    }

}