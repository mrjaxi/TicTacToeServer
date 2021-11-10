<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'login')]
    public function login(Request $request): Response
    {
        return $this->render('login/index.html.twig', [
            'controller_name' => 'LoginController',
            'login' => $request->query->get('login'),
            'password' => $request->query->get('password')
        ]);
    }

    #[Route('/register', name: 'register')]
    public function register(Request $request): Response
    {
        return $this->render('login/register.html.twig', [
            'controller_name' => 'RegisterController',
            'login' => $request->query->get('login'),
            'password' => $request->query->get('password')
        ]);
    }
}
