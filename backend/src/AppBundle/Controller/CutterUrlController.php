<?php

namespace AppBundle\Controller;

// use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
// use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Utils\UrlCompressHelper;
use AppBundle\Entity\Url;
use Symfony\Component\HttpFoundation\JsonResponse;

class CutterUrlController extends Controller
{
    public function indexAction()
    {
        return $this->render('cutter-url/main.html.twig');
    }

    public function testAction(Request $request)
    {
        header('Access-Control-Allow-Origin: *');
        // return 'testt';
        return new JsonResponse('testtter');
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

        return $this->render('cutter-url/infoEach.html.twig', [
            'url' => $url
        ]);
    }

    public function saveUrlAction(Request $request)
    {
        if (!$request->isXmlHttpRequest()) {
            return $this->redirectToRoute('cutter-main');
        }

        $url = $request->request->get('url');
        $urlHelper = new UrlCompressHelper($this->container);

        return $urlHelper->saveUrl($url);
    }
}
