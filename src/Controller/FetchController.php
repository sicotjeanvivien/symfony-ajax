<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/fetch")
 */
class FetchController extends AbstractController
{
    /**
     * @Route("/", name="fetch_index")
     */
    public function index(): Response
    {
        return $this->render('fetch/index.html.twig');
    }

    /**
     * @Route("/api", name="fetch_get", methods={"GET"})
     */
    public function fetchget(): Response
    {
        $response = new Response();
        $response->setContent(json_encode('hello'));
        $response->headers->set('content-type', 'application/json');
        $response->setStatusCode(200);

        return $response;
    }

    /**
     * @Route("/api", name="fetch_post", methods={"POST"})
     */
    public function fetchpost(Request $request): Response
    {
        $response = new Response();
        $response->headers->set('content-type', 'application/json');
        $response->setStatusCode(200);

        if ($request->headers->get('content-type') === 'application/json') {
            $data = json_decode($request->getContent(), true);
            $response->setContent(json_encode(bin2hex($data)));
            
            return $response;
        } else {
            $response->setContent(json_encode('error'));
            
            return $response;
        }
    }
}
