<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

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
}