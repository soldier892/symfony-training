<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;

class LuckyControllerController extends Controller
{
    /**
     * @Route("/lucky/number", name="lucky_number")
     */

    public function numberAction()
    {
        $number = random_int(10, 20);

        //return variable via Http Response

//        return new Response('<html><body> Lucky Number :'.$number.'</body></html>');

        //return variable by rendering to twig template file

        return $this->render('lucky/number.html.twig', array('number' => $number));
    }
}
