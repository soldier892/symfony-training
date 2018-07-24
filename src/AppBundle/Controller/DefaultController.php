<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/translate", name="translate")
     */

    public function getTranslator()
    {
        $translated = $this->get('translator')->trans("J'aime Symfony");
//        return new Response('<html><body> '.$translated.'</body></html>');

        return $this->render('translate/translation.html.twig', array("name" => $translated, "count"=>2));
    }
}
