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
                    $bot = $request->query->getBoolean('bot');
                    $winner = $request->query->getBoolean('winner');
                    $leftState = $request->query->get('leftState');
                    $rightState = $request->query->get('rightState');
                    $imagesId = $request->query->get('imagesID');
                    $date = $request->query->get('date');

                    $userToken = $request->query->get('token');

                    if (!isset($bot) || !isset($winner) || empty($leftState) ||
                        empty($rightState) || empty($imagesId) || empty($date) || empty($userToken)) {
                        throw new \RuntimeException("Не все поля переданы".$bot.$winner);
                    }
                    $userID = $this->usersService->getUserByToken($userToken)->getId();

                    $imagesIdArr = explode(",",$imagesId);
                    $gameData = $this->gameDataService->createGameData(
                        $bot, $winner, $leftState, $rightState, $imagesIdArr, $date,$userID
                    );

                    $gameID = $gameData->getMatchid();
                    $this->gameService->saveUserGame($userID, $gameID);


                    $api_request['response'] = array(
                        "method" => "saveGameData",
                        "response" => $gameData
                    );
                    break;
                case "getAllGames":
                    $api_request['response'] = array(
                        "method" => "getUsers",
                        "response" => $this->gameDataService->getGamesData()
                    );
                    break;
                case "getGamesByToken":
                    $token = $request->query->get('token');

                    if (empty($token)) {
                        throw new \RuntimeException("Передайте token поле");
                    }

                    $api_request['response'] = array(
                        "method" => "getGamesByToken",
                        "response" => $this->gameDataService->getGamesByToken($token)
                    );
                    break;
                case "deleteGameById":
                    $matchId = $request->query->getInt('matchId');

                    if (empty($matchId)) {
                        throw new \RuntimeException("Передайте поле matchId");
                    }

                    $api_request['response'] = array(
                        "method" => "getGamesByToken",
                        "response" => $this->gameDataService->deleteGameById($matchId)
                    );
                    break;
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
