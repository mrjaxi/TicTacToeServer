<?php

namespace App\Controller;


use App\Users\Service\UsersServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AuthController extends AbstractController
{

    private $usersService;

    public function __construct(UsersServiceInterface $usersService)
    {
        $this->usersService = $usersService;
    }

    #[Route('/login', name: 'login')]
    public function login(Request $request): Response
    {
        $userLogin = $request->query->get('userLogin');
        $userPassword = md5($request->query->get('userPassword'));

        if (!isset($userLogin, $userPassword)){
            throw new \RuntimeException("Поля userLogin и userPassword должны быть не пустыми");
        }

        $user = $this->usersService->loginUser($userLogin, $userPassword);

        if ($user){
            try {
                $token = rtrim(strtr(base64_encode(random_bytes(32)), '+/', '-_'), '=');

                $user->setUsertoken($token);

                $this->usersService->updateUserCredentials(
                    $user
                );

                $api_request['response'] = array(
                    "method" => "loginUser",
                    "userName" => $userLogin,
                    "userPassword" => $userPassword,
                    "token" => $token
                );
            } catch (\Exception $e) {
            }
        } else {
            throw new \RuntimeException("Неверный логин или пароль pass: {$userPassword}");
        }

        return $this->json($api_request);
    }

    #[Route('/register', name: 'register')]
    public function register(Request $request): JsonResponse
    {
        $userLogin = $request->query->get('userLogin');
        $userPassword = md5($request->query->get('userPassword'));

        $returnValue = $this->usersService->createUser($userLogin, $userPassword);

        $api_request['response'] = array(
            "method" => "registerUser",
            "userName" => $userLogin,
            "userPassword" => $userPassword,
            "token" => $returnValue
        );

        return $this->json($api_request);
    }
}
