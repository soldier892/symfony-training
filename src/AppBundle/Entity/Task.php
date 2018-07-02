<?php

namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Task
{
    /**
     * @var $task
     * @Assert\NotBlank()
     */
    protected $task;

    /**
     * @var $dueDate
     * @Assert\NotBlank()
     * @Assert\Type("\DateTime")
     */
    protected $dueDate;


    public function getTask()
    {
        return $this->task;
    }

    public function setTask($task)
    {
        $this->task = $task;
    }

    public function getDueDate()
    {
        return $this->dueDate;
    }

    public function setDueDate(\DateTime $dueDate = null)
    {
        $this->dueDate = $dueDate;
    }
}
