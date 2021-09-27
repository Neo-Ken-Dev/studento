<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
    /**
     * @Route("/inscription", name="user_inscription")
     */
    public function register(Request $request, EntityManagerInterface $em, UserPasswordEncoderInterface $encoder) {

        $user = new User();
        $registerForm = $this->createForm(RegisterType::class, $user);

        $registerForm->handleRequest($request);
        if ($registerForm->isSubmitted() && $registerForm->isValid()){
            $hashedPassword = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hashedPassword);

            $em->persist($user);
            $em->flush();
        }

        return $this->render("user/register.html.twig", [
            "registerForm" => $registerForm->createView()
        ]);
    }

    /**
     * @Route("/MonProfil", name="my_profil")
     */
    public function MyProfile(Request $request, EntityManagerInterface $em)
    {
        $userConnected = $this->getUser();

        $ShowProfileForm = $this->createForm(RegisterType::class, $userConnected);
        $ShowProfileForm->remove('password');

        $ShowProfileForm->handleRequest($request);
        if ($ShowProfileForm->isSubmitted() && $ShowProfileForm->isValid()){

            $em->persist($userConnected);
            $em->flush();
        }

        return $this->render("user/myProfile.html.twig", ['userConnected' => $userConnected,
            "ShowProfileForm" => $ShowProfileForm->createView()
        ]);
    }

    /**
     * @Route("/connexion", name="login")
     */
    public function login() {return $this->render("user/login.html.twig");}
    /**
     * @Route("/logout", name="logout")
     */
    public function logout() {}
}