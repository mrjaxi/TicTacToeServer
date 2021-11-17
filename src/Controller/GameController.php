<?php

namespace App\Controller;

use App\Game\Service\GameServiceInterface;
use App\GameData\Service\GameDataServiceInterface;
use App\Users\Service\UsersServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GameController extends AbstractController
{
    private $usersService;
    private $gameDataService;
    private $gameService;

    public function __construct(UsersServiceInterface $usersService,
                                GameDataServiceInterface $gameDataService,
                                GameServiceInterface $gameService)
    {
        $this->gameDataService = $gameDataService;
        $this->usersService = $usersService;
        $this->gameService = $gameService;
    }

    #[Route('/gameMethod.{name<\w+>}', name: 'game')]
    public function index(string $name, Request $request): JsonResponse
    {
        try {
            switch ($name) {
                case "saveGameData":
                    $bot = $request->query->get('bot');
                    $winner = $request->query->get('winner');
                    $leftState = $request->query->get('leftState');
                    $rightState = $request->query->get('rightState');
                    $imagesid = $request->query->get('imagesID');
                    $date = $request->query->get('date');

                    $userToken = $request->query->get('token');

                    if (empty($bot) || empty($winner) || empty($leftState) ||
                        empty($rightState) || empty($imagesid) || empty($date) || empty($userToken)) {
                        throw new \RuntimeException("Не все поля переданы");
                    }

                    $gamaData = $this->gameDataService->createGameData(
                        $bot, $winner, $leftState, $rightState, $imagesid, $date
                    );

                    $gameID = $gamaData->getMatchid();
                    $userID = $this->usersService->getUserByToken($userToken)->getId();

                    $this->gameService->saveUserGame($userID, $gameID);
                    break;
                case "testGameSend":
                    return $this->json(array("name" => $request->query->get('imagesID') . explode(",", "")));
                default:
                    $api_request['response'] = array(
                        "error" => "Несуществующий api"
                    );
            }
            return $this->json("NoError");
        } catch (\RuntimeException $e){
            return $this->json( array("error" => $e->getMessage()) );
        }
    }
}
