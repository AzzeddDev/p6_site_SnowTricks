<?php

namespace App\Controller\Membres;

use App\Entity\Membres;
use App\Form\RegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class MembresController extends AbstractController
{

    /**
     * @Route("/signup", name="signup")
     */
    public function signup(Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder) {

        $user = new Membres();
        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hash = $encoder->encodePassword($user, $user->getMotdepasse());

            $user->setMotdepasse($hash);

            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('security_login');
        }

        return $this->render('membres/signup.html.twig', [
            'form' => $form->createView()
        ]);

    }


    /**
     * @Route("/login", name="security_login")
     */
    public function login(): Response
    {
        return $this->render('membres/login.html.twig', [
        ]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout() {
        throw new \Exception('Don\'t forget to activate logout in security.yaml');
    }
}
