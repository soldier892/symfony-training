<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class TempController extends Controller
{
    /**
     * @param $key
     * @Route("/template/{key}", name="temp_index", requirements={"key":"\d+"})
     */

    public function getTemplate($key)
    {
        $arr = array();

        for ($i=0; $i<$key; $i++) {
            $arr[$i] = $i;
        }

        return $this->render("temp/template.html.twig", array("values" => $arr));
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/master/template/", name="master_template")
     */

    public function masterTemplate()
    {

        return $this->render("masterlayout/index1.html.twig");
    }
}
