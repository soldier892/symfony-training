<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FormController extends Controller
{

    /**
     * @param Request $request
     * @Route("/form/", name="new_form")
     */

    public function newForm(Request $request)
    {

        $task = new Task();

        $task->setTask("Write a Blog Post");
        $task->setDueDate(new \DateTime("tomorrow"));

        $form = $this->createFormBuilder($task)
            ->add('Task', TextType::class)
            ->add('dueDate', DateType::class, array('widget' => 'single_text'))
            ->add('save', SubmitType::class, array('label' =>'Create Task'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();

            // $entityManager = $this->getDoctrine()->getManager();
            // $entityManager->persist($task);
            // $entityManager->flush();

            return $this->redirectToRoute("master_template");
        }

        return $this->render('/Forms/new_form.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
