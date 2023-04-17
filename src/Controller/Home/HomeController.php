<?php

namespace App\Controller\Home;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(ArticleRepository $repo, Request $request): Response {

        $page = $request->query->get('page');
        if ($page === null) {
            $page = 1;
        }
        $articles = $repo->findArticlePaginated($page);

        return $this->render('home/home.html.twig', [
            'articles' => $articles,
            'page' => $page,
        ]);
    }
}
