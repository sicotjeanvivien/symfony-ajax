<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class APIController extends AbstractController
{

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    /**
     * @Route("/api/index", name="api")
     */
    public function index()
    {
        return $this->render('api/index.html.twig', [
            'controller_name' => 'APIController',
            'article' => ''
        ]);
    }

    /**
     * @Route("/api/show", name="api_show")
     */
    public function show(Request $request)
    {

        $error = false;
        $message = '';
        $articles = $this->articleRepository->findAll();

        $view = $this->renderView('api/view/tbody-row.html.twig', [
            'articles' => $articles,
        ]);

        $response = [
            'error' => $error,
            'message' => $message,
            'view' => $view,
        ];

        return new JsonResponse($response);
    }

    /**
     * @Route("/api/create", name="api_create")
     */
    public function create(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $data = json_decode($request->getContent(), true);

        dump($data);

        $error = false;
        $message = '';

        $article = new Article;
        $article->setTitle($data['title'])
            ->setContent($data['content'])
            ->setAuthor($data['author'])
            ->setDatePublished(new DateTime($data['datePublished']));
        $em->persist($article);
        $em->flush();


        $articles = $this->articleRepository->findAll();
        $view = $this->renderView('api/view/tbody-row.html.twig', [
            'articles' => $articles,
            
        ]);

        $response = [
            'error' => $error,
            'message' => $message,
            'view' => $view,
        ];

        return new JsonResponse($response);
    }


    /**
     * @Route("/api/delete", name="api_delete")
     */
    public function delete(Request $request)
    {

        $data = json_decode($request->getContent(), true);

        dump($data);

        $article = $this->articleRepository->findOneBy(['id' => $data['id']]);

        $em = $this->getDoctrine()->getManager();
        $em->remove($article);
        $em->flush();

        $error = false;
        $message = '';
        $articles = $this->articleRepository->findAll();

        $view = $this->renderView('api/view/tbody-row.html.twig', [
            'articles' => $articles,
        ]);

        $response = [
            'error' => $error,
            'message' => $message,
            'view' => $view,
        ];

        return new JsonResponse($response);
    }

    /**
     * @Route("/api/updateGetData", name="api_updateGetData")
     */
    public function updateGetData(Request $request)
    {

        $data = json_decode($request->getContent(), true);
        $article = $this->articleRepository->findOneBy(['id' => $data['id']]);
        $error = false;
        $message = '';
        dump($article, $data);
        

        $view = $this->renderView('api/view/contentCreateModal.html.twig', [
            'article' => $article,
        ]);

        $response = [
            'error' => $error,
            'message' => $message,
            'view' => $view,
        ];

        return new JsonResponse($response);
    }

     /**
     * @Route("/api/update", name="api_updateDataSend")
     */
    public function update(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $data = json_decode($request->getContent(), true);

        dump($data);

        $error = false;
        $message = '';

        $article = $this->articleRepository->findOneBy(['id' => $data['id']]);
        $article->setTitle($data['title'])
            ->setContent($data['content'])
            ->setAuthor($data['author'])
            ->setDatePublished(new DateTime($data['datePublished']));
        $em->flush();


        $articles = $this->articleRepository->findAll();
        $view = $this->renderView('api/view/tbody-row.html.twig', [
            'articles' => $articles,
            
        ]);

        $response = [
            'error' => $error,
            'message' => $message,
            'view' => $view,
        ];

        return new JsonResponse($response);
    }
}
