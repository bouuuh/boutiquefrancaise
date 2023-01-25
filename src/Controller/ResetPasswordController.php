<?php

namespace App\Controller;

use App\Classe\Mail;
use App\Entity\ResetPassword;
use App\Entity\User;
use App\Form\ResetPasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ResetPasswordController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/mot-de-passe-oublie', name: 'reset_password')]
    public function index(Request $request): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('app_home');
        }

        if ($request->get('email')) {
            $user = $this->entityManager->getRepository(User::class)->findOneByEmail($request->get('email'));
                if ($user) {
                $reset_password = new ResetPassword();
                $reset_password->setUser($user);
                $reset_password->setToken(uniqid());
                $reset_password->setCreateAt(new \DateTime);
                $this->entityManager->persist($reset_password);
                $this->entityManager->flush();

                $mail = new Mail();
                $url = $this->generateUrl('update_password', [
                    'token' => $reset_password->getToken()
                ]);
                $content = 'Bonjour '.$user->getFirstName().'<br>Vous avez demandé de réinitialiser votre mot de passe.<br>';
                $content .= 'Merci de bien vouloir cliquer sur<a href="'.$url.'"> le lien suivant </a>pour mettre à jour votre mot de passe.';
                $mail->send($user->getEmail(), $user->getFirstName() . ' ' . $user->getLastName(), 'Réinitialiser le mot de passe sur la Boutique Française', $content);
                $this->addFlash('notice', 'Vous allez recevoir un email.');    
            } else {
                    
            $this->addFlash('notice', 'Cette adresse email est inconnue.');
                }
        }

        return $this->render('reset_password/index.html.twig');
    }

    
     #[Route('/modifier-mot-de-passe/{token}', name: 'update_password')]
     
    public function update($token, Request $request, UserPasswordEncoderInterface $encoder)
    {
        $reset_password = $this->entityManager->getRepository(ResetPassword::class)->findOneByToken($token);

        if (!$reset_password) {
            return $this->redirectToRoute('reset_password');
        }

        $now = new \DateTime;
        if ($now > $reset_password->getCreateAt()->modify('+ 3 hour')) {
            $this->addFlash('notice', 'Votre demande de réinitialisation de mot de passe a expirée.');
            return $this->redirectToRoute('reset_password');
        } 


        $form = $this->createForm(ResetPasswordType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $new_pwd = $form->get('new_password')->getData();

            $password = $encoder->encodePassword($reset_password->getUser(), $new_pwd);
            $reset_password->getUser()->setPassword($password);
            $this->entityManager->flush();

            $this->addFlash('notice', 'Votre mot de passe a bien été mis à jour.');
            return $this->redirectToRoute('app_login');
        }

        return $this->render('reset_password/update.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
