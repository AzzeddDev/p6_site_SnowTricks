<?php

namespace App\Controller\Tricks;

use App\Entity\Comment;
use App\Entity\Images;
use App\Form\CommentType;
use App\Repository\CommentRepository;
use App\Repository\ImagesRepository;
use Doctrine\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Article;
use App\Form\AddTrickType;

class BlogController extends AbstractController
{

    /**
     * @Route("/trick/{title}", name="trick_show")
     */
    public function show(Article $article, CommentRepository $repo, Request $request, EntityManagerInterface $manager): Response {

        //Créer un nouveau commentaire
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);

        //Rajout d'un commentaire
        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setCreatedAt(new \DateTime())
                    ->setArticle($article)
                    ->setAuthor($this->getUser());
            $manager->persist($comment);
            $manager->flush();

            return $this->redirectToRoute('trick_show', ['title' => $article->getTitle()]);
        }

        //Pagination des commentaires
        $page = $request->query->get('page');
        if ($page === null) {
            $page = 1;
        }

        $comments = $repo->findCommentPaginated($article, $page);

        return $this->render('blog/show.html.twig', [
            'article' => $article,
            'commentForm' => $form->createView(),
            'comments' => $comments,
            'page' => $page,
        ]);
    }
}
