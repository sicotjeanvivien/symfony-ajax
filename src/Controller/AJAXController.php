<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ajax")
 */
class AJAXController extends AbstractController
{

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    /**
     * @Route("/index", name="api")
     */
    public function index()
    {
        return $this->render('js/index.html.twig', [
            'controller_name' => 'APIController',
            'article' => ''
        ]);
    }

    /**
     * @Route("/show", name="api_show")
     */
    public function show(Request $request)
    {

        $error = false;
        $message = '';
        $articles = $this->articleRepository->findAll();

        $view = $this->renderView('js/view/tbody-row.html.twig', [
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
     * @Route("/create", name="api_create")
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
        $view = $this->renderView('js/view/tbody-row.html.twig', [
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
     * @Route("/delete", name="api_delete")
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

        $view = $this->renderView('js/view/tbody-row.html.twig', [
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
     * @Route("/updateGetData", name="api_updateGetData")
     */
    public function updateGetData(Request $request)
    {

        $data = json_decode($request->getContent(), true);
        $article = $this->articleRepository->findOneBy(['id' => $data['id']]);
        $error = false;
        $message = '';
        dump($article, $data);
        

        $view = $this->renderView('js/view/contentCreateModal.html.twig', [
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
     * @Route("/update", name="api_updateDataSend")
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
        $view = $this->renderView('js/view/tbody-row.html.twig', [
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
