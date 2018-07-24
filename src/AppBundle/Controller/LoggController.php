<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class LoggController extends Controller
{

    /**
     * @param LoggerInterface $logger
     * @Route("/logger/", name="logger_action")
     */
    public function logAction()
    {
        $logger = $this->get('logger');

        $logger->info("Hye, This is an Info Message");
        $logger->error("Hye, This is an Info Message");

        $logger->critical("Critical Message!", array(
           'cause' => 'in_hurry',
        ));

        return  new Response("Response");
    }
}
