<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
    /**
     * @Route("/addUser" , name="add_user")
     */
    public function add(EntityManagerInterface $em)
    {
        //@todo: formulaire de création de user

        //@below: création d'un user pour tester sans formulaire
        $user = new User();
        $user->setLastname("Lemonnier");
        $user->setFirstname("Ken");
        $user->setUsername("kenL");
        $user->setEmail("lemonnier.ken@gmail.com");
        $user->setPassword("1234");

        $em->persist($user);
        $em->flush();

       return $this->render('default/home.html.twig');
    }

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
     * @Route("/connexion", name="login")
     */
    public function login() {
        return $this->render("user/login.html.twig");
    }

    /**
     * @Route("/logout", name="logout")
     *
     */
    public function logout() {}
}