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
        try {
            $userLogin = $request->query->get('userLogin');
            $userPassword = $request->query->get('userPassword');

            if (empty($userLogin) || empty($userPassword)) {
                throw new \RuntimeException("Поля userLogin и userPassword должны быть не пустыми");
            }

            $user = $this->usersService->loginUser($userLogin, md5($userPassword));

            if ($user) {
                $token = rtrim(strtr(base64_encode(random_bytes(32)), '+/', '-_'), '=');

                $user->setUsertoken($token);

                $this->usersService->updateUserCredentials(
                    $user
                );

                $api_request['response'] = array(
                    "method" => "loginUser",
                    "userName" => $userLogin,
                    "userPassword" => $userPassword,
                    "token" => $user->getUsertoken()
                );
            } else throw new \RuntimeException("Неверный логин или пароль pass: {$userPassword}");

            return $this->json($api_request);
        }catch(\RuntimeException $e){
            return $this->json( array("error" => $e->getMessage()) );
        }catch (\Exception $e){
            return $this->json( array("error" => $e->getMessage()) );
        }
    }

    #[Route('/register', name: 'register')]
    public function register(Request $request): JsonResponse
    {
        try {
            $userLogin = $request->query->get('userLogin');
            $userPassword = $request->query->get('userPassword');

            if (empty($userLogin) || empty($userPassword)) {
                throw new \RuntimeException("Поля userLogin и userPassword должны быть не пустыми");
            }

            if (strlen($userPassword) < 4){
                throw new \RuntimeException("Пароль должен иметь не меньше 4 символов");
            }

            $returnValue = $this->usersService->createUser($userLogin, md5($userPassword));

            $api_request['response'] = array(
                "method" => "registerUser",
                "userName" => $userLogin,
                "userPassword" => $userPassword,
                "token" => $returnValue
            );

            return $this->json($api_request);
        } catch (\RuntimeException $e) {
            return $this->json( array("error" => $e->getMessage()) );
        }
    }
}
