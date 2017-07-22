<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class CutterUrlController extends Controller
{
    public function indexAction(Request $request)
    {
        dump($request);
        $title = 'Hello Symfony';

        return $this->render('cutter-url/main.html.twig', [
            'title' => $title
        ]);
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
    }
}
