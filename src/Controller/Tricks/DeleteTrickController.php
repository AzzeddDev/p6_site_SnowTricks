<?php

namespace App\Controller\Tricks;

use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeleteTrickController extends AbstractController
{
    /**
     * @Route("/trick/{title}/delete", name="trick_delete")
     * @param Article $article
     * @return RedirectResponse
     */
    public function delete(Article $article): RedirectResponse
    {
        $dt = $this->getDoctrine()->getManager();
        $dt->remove($article);
        $dt->flush();

        return $this->redirectToRoute("home");
    }
}
