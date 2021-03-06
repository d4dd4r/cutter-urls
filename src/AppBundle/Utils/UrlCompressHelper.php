<?php

namespace AppBundle\Utils;

use AppBundle\Entity\Url;
use Symfony\Component\HttpFoundation\JsonResponse;

class UrlCompressHelper
{
    private $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function saveUrl($url)
    {
        if (!$this->isUrlValid($url)) {
            return new JsonResponse([
                'status' => 'fail',
                'code' => 'Url validation has failed'
            ]);
        }

        if (!$this->isGoodResponse($url)) {
            return new JsonResponse([
                'status' => 'fail',
                'code' => 'Url has wrong code response'
            ]);
        }

        $urlCompressed = $this->getCompressedUrl($url);

        $urlEntity = new Url();
        $urlEntity->setUrl($url);
        $urlEntity->setUri($urlCompressed);

        $em = $this->container->get('doctrine')->getManager();
        $em->persist($urlEntity);
        $em->flush();

        return new JsonResponse([
            'status' => 'success',
            'data' => [
                'url' => $url,
                'urlCompressed' => $urlCompressed
            ]
        ]);
    }

    public function removeOldUrls()
    {
        $doctrine = $this->container->get('doctrine');
        $em = $doctrine->getManager();
        $allUrls = $doctrine->getRepository(Url::class)->findAll();
        $daysLimit = $this->container->getParameter('days_limit_to_remove');

        $names = [];
        foreach ($allUrls as $k => $url) {
            $created = $url->getCreated();
            $now = new \DateTime('now');
            $diff = $now->diff($created);
            $daysDiff = (int) $diff->format('%a');

            if ($daysDiff >= $daysLimit) {
                $names[] = $url->getUrl();
                $em->remove($url);
            }
        }

        if (!empty($names)) $em->flush();

        return $names;
    }

    private function getCompressedUrl()
    {
        $symbols = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j'];
        $string = time() . mt_rand(10, 99);

        $url = '';
        for ($i=0; $i < strlen($string); $i++) {
            $url .= $symbols[ $string[$i] ];
        }

        return $url;
    }

    private function isUrlValid($url)
    {
        $pattern = '/^((https|http):\/\/)([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/i';
        preg_match($pattern, $url, $matches, PREG_OFFSET_CAPTURE);

        return (boolean) $matches;
    }

    private function isGoodResponse($url)
    {
        $code = $this->getHttpResponseCode($url);

        return $code === 200;
    }

    private function getHttpResponseCode($url)
    {
        $headers = get_headers($url);

        return (integer) substr($headers[0], 9, 3);
    }
}
