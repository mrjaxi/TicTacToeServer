<?php

namespace App\Controller;

use App\Entity\User;
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
                    'User1' => true,
                    'User2' => false,
                    'gameToken' => $request->query->get('game_token'),
                    'userPassword' => $this->encoder->encodePassword(new User(), "Password"),
                );
                break;
            case "loginUser":
                $userLogin = $request->query->get('userLogin');
                $userPassword = $request->query->get('userPassword');

                $returnValue = $this->usersService->createUser($userLogin, $userPassword);

                $api_request['response'] = array(
                    "userName" => $userLogin,
                    "token" => $returnValue
                );
                break;
            case "getUsers":
                $api_request['response'] = $this->usersService->getUsers();
                break;
        }

        return $this->json($api_request);
    }
}
