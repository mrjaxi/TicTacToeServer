<?php

namespace App\Controller;

use App\Entity\User;
use App\Users\Model\Users;
use App\Users\Service\UsersServiceInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ApiController
 * @package App\Controller
 */
class ApiController extends AbstractController
{

    private $encoder;
    private $usersService;

    public function __construct(UserPasswordEncoderInterface $encoder, UsersServiceInterface $usersService)
    {
        $this->usersService = $usersService;
        $this->encoder = $encoder;
    }

    #[Route('/api/method.{name<\w+>}', name: 'api')]
    public function api(string $name, Request $request): JsonResponse
    {
        switch ($name) {
            case "getUserMove":
                $api_request['userMove'] = array(
                    "method" => "getUserMove",
                    'User1' => true,
                    'User2' => false,
                );
                break;
            case "registerUser":
                $userLogin = $request->query->get('userLogin');
                $userPassword = md5($request->query->get('userPassword'));

                $returnValue = $this->usersService->createUser($userLogin, $userPassword);

                $api_request['response'] = array(
                    "method" => "registerUser",
                    "userName" => $userLogin,
                    "userPassword" => $userPassword,
                    "token" => $returnValue
                );
                break;
            case "loginUser":
                $userLogin = $request->query->get('userLogin');
                $userPassword = md5($request->query->get('userPassword'));

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
                            "token" => $token
                        );
                    } catch (\Exception $e) {
                    }
                } else {
                    throw new \RuntimeException("Неверный логин или пароль pass: {$userPassword}");
                }
                break;
            case "getUsers":
                $api_request['response'] = array(
                    "method" => "getUsers",
                    "users" => $this->usersService->getUsers()
                );
                break;
        }

        return $this->json($api_request);
    }
}
