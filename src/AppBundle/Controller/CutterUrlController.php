<?php

namespace AppBundle\Controller;

// use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
// use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Url;

class CutterUrlController extends Controller
{
    public function indexAction()
    {
        // $em = $this->getDoctrine()->getManager();
        // $url = new Url();

        // $url->setUrl('https://www.yandex.ru');
        // $url->setUri('/kasdihfn');
        // $url->setCountJumps(0);

        // $em->persist($url);
        // $em->flush();

        // $uri = $this->getDoctrine()
        //     ->getRepository(Url::class)
        //     ->find(1)
        //     ->getUri();

        return $this->render('cutter-url/main.html.twig', [
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
