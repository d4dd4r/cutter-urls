<?php

namespace AppBundle\Controller;

// use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Url;
use AppBundle\Utils\UrlCompressHelper;

class CutterUrlController extends Controller
{
    public function indexAction()
    {
        // $em = $this->getDoctrine()->getManager();
        // dump($em);
        // $url = new Url();

        // $url->setUrl('https://www.yandex.ru');
        // $url->setUri('/11111sss');
        // $url->setCountJumps(0);

        // $em->persist($url);
        // $em->flush();

        // $uri = $this->getDoctrine()
        //     ->getRepository(Url::class)
        //     ->find(1)
        //     ->getUri();

        return $this->render('cutter-url/main.html.twig');
    }

    public function infoAction($urlId)
    {
        return $this->render('cutter-url/info.html.twig', [
            'page' => $urlId
        ]);
    }

    public function saveUrlAction(Request $request)
    {
        if (!$request->isXmlHttpRequest()) {
            return $this->redirectToRoute('cutter-main');
        }

        $url = $request->request->get('url');
        if (empty($url) || !UrlCompressHelper::isGoodResponse($url)) {
            return new Response(json_encode([
                'status' => 'fail'
            ]));
        }

        $urlCompressed = $this->saveUrl($url);

        return new Response(json_encode([
            'status' => 'success',
            'data' => [
                'url' => $url,
                'urlCompressed' => $urlCompressed
            ],
        ]));
    }

    private function saveUrl($url) {
        $em = $this->getDoctrine()->getManager();
        $shortUri = UrlCompressHelper::getShortUri();
        $urlEntity = new Url();

        $urlEntity->setUrl($url);
        $urlEntity->setUri($shortUri);
        $urlEntity->setCountJumps(0);

        $em->persist($urlEntity);
        $em->flush();

        return $shortUri;
    }
}
