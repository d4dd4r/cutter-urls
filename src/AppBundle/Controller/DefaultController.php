<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Url;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        return $this->redirectToRoute('cutter-main');
    }

    public function redirectAction(Request $request, $uri)
    {
        $doctrine = $this->getDoctrine();
        $repository = $doctrine->getRepository(Url::class);
        $em = $doctrine->getManager();

        $urlEntity = $repository->findOneByUri($uri);
        if (empty($urlEntity)) {
            return $this->render('cutter-url/nolink.html.twig');
        }

        $urlEntity->increasCountJumps();
        $url = $urlEntity->getUrl();

        $em->persist($urlEntity);
        $em->flush();

        // return $this->render('cutter-url/main.html.twig');
        return $this->redirect($url);
    }
}
