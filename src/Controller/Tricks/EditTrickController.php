<?php

namespace App\Controller\Tricks;

use App\Entity\Article;
use App\Form\EditArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EditTrickController extends AbstractController
{
    /**
     * @Route("/test", name="test")
     */
    public function form(Article $article): Response
    {
        $form = $this->createForm(EditArticleType::class, $article);
        return $this->render('edit_trick/edit.html.twig', [

        ]);
    }
}
