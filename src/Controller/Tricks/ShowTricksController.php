<?php

namespace App\Controller\Tricks;

use App\Form\CommentType;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class ShowTricksController extends AbstractController
{
    /**
     * @Route("/tricks", name="tricks")
     */
    public function index(ArticleRepository $repo): Response
    {
        $articles = $repo->findAll();

        return $this->render('blog/blog.html.twig', [
            'articles' => $articles
        ]);
    }
}
