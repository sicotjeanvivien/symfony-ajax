<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/jquery")
 */
class JqueryController extends AbstractController
{
    /**
     * @Route("/index", name="jquery_index")
     */
    public function index(): Response
    {
        return $this->render('jquery/index.html.twig');
    }

  
}
