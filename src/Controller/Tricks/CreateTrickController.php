<?php

namespace App\Controller\Tricks;

use App\Entity\Article;
use App\Entity\Images;
use App\Form\AddTrickType;
use App\Form\EditArticleType;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\Null_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreateTrickController extends AbstractController
{
    /**
     * @Route("/tricks/new", name="trick_create")
     * @Route("/tricks/{title}/edit", name="trick_edit")
     */
    public function form(Article $article = Null, Request $request, EntityManagerInterface $manager)
    {
        if (!$article) {
            $article = new Article();
        }

        $form = $this->createForm(AddTrickType::class, $article);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // On récupère les images transmises
            $images = $form->get('image')->getData();

            // On boucle sur les images
            foreach ($images as $image){
                //On génère un nouveau nom de fichier

                $ficher = md5(uniqid()) . '.' . $image->guessExtension();

                //On copie le fichier dans le dossier uploads 'images_tricks'
                $image->move($this->getParameter('trick_images_directory'), $ficher);

                // On stocke l'image dans la base de données (son nom)
                $img = new Images();
                $img->setLink($ficher)->setArticle($article);
                $article->getImages()->add($img);
                $manager->persist($img);
            }


            // On récupère l'image transmise
            /** @var UploadedFile $featured_image */
            $featured_image = $form->get('featured_img')->getData();

            if ($featured_image !== null) {
                //On génère un nouveau nom de fichier
                $ficher = md5(uniqid()) . '.' . $featured_image->getClientOriginalExtension();

                //On copie le fichier dans le dossier uploads 'bg_trick'
                $featured_image->move($this->getParameter('trick_bg_directory'), $ficher);

                // On stocke l'image dans la base de données (son nom)
                $article->setFeaturedImg($ficher);
            }


            $article->setCreatedAt(new \DateTime());

            $manager->persist($article);
            $manager->flush();

            return $this->redirectToRoute('trick_show', ['title' => $article->getTitle()]);
        }

        return $this->render('create/create.html.twig', [
            'formArticle' => $form->createView(),
            'editMode' => $article->getId() !== null,
            'article' => $article,
        ]);
    }
}
