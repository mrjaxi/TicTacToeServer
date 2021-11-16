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

    private $usersService;

    public function __construct(UserPasswordEncoderInterface $encoder, UsersServiceInterface $usersService)
    {
        $this->usersService = $usersService;
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
