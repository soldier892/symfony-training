<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Form\TaskType;
use AppBundle\Entity\Task;

class CustomFormController extends Controller
{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/custom/form/", name="custom_form")
     */

    public function newAction()
    {
        $task = new Task();

        $task->setTask("Write a Blog Post");
        $task->setDueDate(new \DateTime("tomorrow"));
        $form = $this->createForm(TaskType::class, $task);

        return $this->render('/Forms/new_form.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
