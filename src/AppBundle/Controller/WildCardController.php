<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class WildCardController extends Controller
{
    /**
     * @Route("/number/list", name="number_list")
     */

    public function listNumbers()
    {
        return $this->render('wildcard/numberList.html.twig', array(
            'number1' => 10,
            'number2' => 20,
            'number3' => 30,
            'number4' => 40,
            'number5' => 50,
            ));
    }

    /**
     * @Route("/number/{key}", name="key_number", requirements={"key"="\d+"})
     */

    public function getNumber($key = 1)
    {

        return $this->render('wildcard/keyNumber.html.twig', array(
            'number' => $key,
        ));
    }

    /**
     * @Route("/articles/{_locale}/{year}/{value}.{_format}",
     *     defaults={"_format": "html"},
     *     requirements={
     *         "_locale" = "en|fr",
     *         "_format" = "html|rss",
     *         "year" : "\d+"
     *     }
     * )
     */

    public function advanceRoute($_locale, $year, $value)
    {
        return $this->render('wildcard/advanceRoutes.html.twig', array(
            'locale' => $_locale,
            'year' => $year,
            'value' => $value,
        ));
    }

    /**
     * @Route("/generate/url/", name="generate_url")
     */

    public function createURL()
    {

        // Standard URL

        $url = $this->generateUrl(
            'generate_url',
            array('slug' => 50)
        );

        return new Response('<html><body> Generated URL :'.$url.'</body></html>');
    }

    /**
     * @Route("/query/string/url/", name="query_string_url")
     */

    public function queryStringURL()
    {

        // URL with Query String

        $url = $this->get('router')->generate('query_string_url', array(
            'page' => 2,
            'category' => 'Symfony',
        ));

        return new Response('<html><body> Query String URL :'.$url.'</body></html>');
    }


    /**
     * @Route("/absolute/url/", name="absolute_url")
     */

    public function absoluteURL()
    {
        // Absolute URL

        $url = $this->generateUrl(
            'absolute_url',
            array('slug' => 'my-blog-post'),
            UrlGeneratorInterface::ABSOLUTE_URL
        );

        return new Response('<html><body> Absolute URL :'.$url.'</body></html>');
    }
}