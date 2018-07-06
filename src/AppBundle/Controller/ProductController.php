<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use AppBundle\Entity\Product;
use AppBundle\Service\MessageGenerator;
use Doctrine\ORM\Mapping\Entity;
use Psr\Log\LoggerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class ProductController extends Controller
{

    /**
     * @return Response
     * @Route("/create/product/", name="create_product")
     */
    public function createProduct(Request $request)
    {
        $product = new Product();




        $form = $this->createFormBuilder($product)
            ->add('name', TextType::class)
            ->add('price', IntegerType::class)
            ->add('description', TextType::class)
            ->add('category', EntityType::class, array(
                'class' => 'AppBundle:Category',
                'choice_label' => 'Select Category'
            ))
            ->add('save', SubmitType::class, array('label' =>'Save Product'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $product = $form->getData();
            $productService = $this->get("app.service.products");

            if ($productService->createProduct($product)) {
                return $this->redirectToRoute('show_product');
            }

//            $entityManager = $this->getDoctrine()->getManager();
//
//            $entityManager->persist($product);
//
//            $entityManager->flush();
        }

        return $this->render('/Forms/new_form.html.twig', array(
            'form' => $form->createView()
        ));




//        $entityManager = $this->getDoctrine()->getManager();
//
//        $product = new Product();
//
//        $product->setName("Iphone 5");
//        $product->setPrice("15000");
//        $product->setDescription("Smart Phone with 5th version of IOS");
//
//        $entityManager->persist($product);
//
//        $entityManager->flush();
//
//        return new Response('Saved new product '.$product->getName());
    }


    /**
     * @Route("/show/product/", name="show_product")
     * @return Response
     */


    public function showProduct()
    {

        // Query For Objects

//        $product = $this->getDoctrine()
//            ->getRepository(Product::class)->findAll();


        //Objects with Doctrine Query Builder

//        $repository = $this->getDoctrine()
//            ->getRepository(Product::class);
//
//        $query = $repository->createQueryBuilder('p')->where('p.price < :price')
//            ->setParameter('price', 20000)->orderBy('p.price', 'DESC')
//            ->getQuery();


        // DQL Query
//        $query = $this->getDoctrine()->getManager()->createQuery('SELECT p
//                 FROM AppBundle:Product p
//                 WHERE p.price > :price
//                 ORDER BY p.id DESC')
//            ->setParameter('price', 19.99);

//        $product = $query->getResult();

        $productService = $this->get("app.service.products");
        $product = $productService->showProduct();

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found'
            );
        } else {
            return $this->render('/Product/products.html.twig', array(
                'products' => $product
            ));
        }
    }


    /**
     * @param Request $request
     * @param $key
     * @Route("/update/{key}", name="update_product", requirements={"key":"\d+"})
     */

    public function updateProduct(Request $request, $key)
    {
//        $entityManager = $this->getDoctrine()->getManager();
//        $product = $entityManager->getRepository(Product::class)->find($key);
//
//        if (!$product) {
//            throw $this->createNotFoundException(
//                'No product found for id '.$key
//            );
//        }
//
//        $form = $this->createFormBuilder($product)
//            ->add('name', TextType::class)
//            ->add('price', \Symfony\Component\Form\Extension\Core\Type\IntegerType::class)
//            ->add('description', TextType::class)
//            ->add('category', EntityType::class, array(
//                'class' => 'AppBundle:Category',
//                'choice_label' => 'Select Category'
//            ))
//            ->add('save', SubmitType::class, array('label' =>'Update Product'))
//            ->getForm();
//
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//              $product->setName($product->getName());
//              $product->setPrice($product->getPrice());
//              $product->setDescription($product->getDescription());
//              $entityManager->flush();
//
//            return $this->redirectToRoute('show_product');
//        }



        $productService = $this->get("app.service.products");
        $product = $productService->findProduct($key);
        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$key
            );
        }
        $form = $this->createFormBuilder($product)
            ->add('name', TextType::class)
            ->add('price', IntegerType::class)
            ->add('description', TextType::class)
            ->add('category', EntityType::class, array(
                'class' => 'AppBundle:Category',
                'choice_label' => 'Select Category'
            ))
            ->add('save', SubmitType::class, array('label' =>'Update Product'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $productService->entityManager->flush();
            return $this->redirectToRoute('show_product');
        }

        return $this->render('/Forms/new_form.html.twig', array(
            'form' => $form->createView()
        ));
    }


    /**
     * @param $key
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/delete/{key}", name="delete_product", requirements={"key":"\d+"})
     */

    public function deleteProduct($key)
    {

//        $entityManager = $this->getDoctrine()->getManager();
//        $product = $entityManager->getRepository(Product::class)->find($key);
//        $entityManager->remove($product);
//        $entityManager->flush();


        $productService = $this->get("app.service.products");
        $productService->deleteProduct($key);

        return $this->redirectToRoute('show_product');
    }


//    /**
//     * @param MessageGenerator $messageGenerator
//     * @Route("/action/")
//     */
//
//    public function newAction(MessageGenerator $messageGenerator)
//    {
//        $message = $messageGenerator->getHappyMessage();
//        $this->addFlash('success',$message);
//
//        return new Response("$message");
//    }
}
