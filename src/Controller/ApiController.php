<?php

namespace App\Controller;

use App\GameData\Service\GameDataServiceInterface;
use App\Users\Service\UsersServiceInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ApiController
 * @package App\Controller
 */
class ApiController extends AbstractController
{

    private $usersService;
    private $gameDataService;

    public function __construct(UsersServiceInterface $usersService, GameDataServiceInterface $gameDataService)
    {
        $this->usersService = $usersService;
        $this->gameDataService = $gameDataService;
    }

     #[Route('/api/method.{name<\w+>}', name: 'api')]
    public function api(string $name, Request $request): JsonResponse
    {
        try {
            switch ($name) {
                case "getUsers":
                    $api_request['response'] = array(
                        "method" => "getUsers",
                        "response" => $this->usersService->getUsers()
                    );
                    break;
                case "deleteUser":
                    $id = $request->query->getInt('id');
                    if (empty($id)) {
                        $username =$request->query->get('username');
                        if (empty($username))
                            throw new \RuntimeException("Поля id или username должны присутствовать");
                        $api_request['response'] = array(
                            "method" => "deleteUser",
                            "response" => $this->usersService->deleteUserByName($username)
                        );
                        break;
                    } else {
                        $api_request['response'] = array(
                            "method" => "deleteUser",
                            "response" => $this->usersService->deleteUserById($id)
                        );
                        break;
                    }
                default:
                    $api_request['response'] = array(
                        "error" => "Несуществующий api"
                    );
            }

            return $this->json($api_request);
        } catch (\RuntimeException $e){
            return $this->json( array("error" => $e->getMessage()) );
        }
    }
}
