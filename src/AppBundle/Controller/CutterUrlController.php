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
        return $this->render('cutter-url/main.html.twig');
    }

    public function infoAction()
    {
        $em = $this->getDoctrine()->getManager();
        $urls = $em->getRepository(Url::class)->findAll();

        return $this->render('cutter-url/info.html.twig', [
            'urls' => $urls
        ]);
    }

    public function infoEachAction($urlId)
    {
        $doctrine = $this->getDoctrine();
        $repository = $doctrine->getRepository(Url::class);

        $url = $repository->find($urlId);

        return $this->render('cutter-url/infoEach.html.twig', array(
            'url' => $url,
        ));
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

        $em->persist($urlEntity);
        $em->flush();

        return $shortUri;
    }
}
