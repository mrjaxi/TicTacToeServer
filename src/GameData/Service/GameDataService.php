<?php
namespace App\GameData\Service;

use App\GameData\Model\GameData;
use App\GameData\Repository\GameDataRepositoryInterface;

class GameDataService implements GameDataServiceInterface
{

    private $repository;

    public function __construct(GameDataRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param bool $bot
     * @param bool $winner
     * @param string $leftState
     * @param string $rightState
     * @param array $imagesId
     * @param string $date
     * @param int $userId
     * @return GameData
     */
    public function createGameData(bool $bot,bool $winner,string $leftState,string $rightState,array $imagesId,string $date,int $userId): GameData
    {
        if (!isset($bot, $winner, $leftState, $rightState, $imagesId, $date)){
            throw new \RuntimeException("Не все поля заполнены createGameData");
        } else {
            $gamedata = new GameData($bot, $winner, $leftState, $rightState, $imagesId, $date, $userId);
            $this->repository->save($gamedata);

            return $gamedata;
        }
    }

    public function getGamesData(): array
    {
        return $this->repository->all();
    }

    /**
     * @param $id
     * @return GameData
     */
    public function getGameById($id): GameData
    {
        return $this->repository->oneById($id);
    }

    /**
     * @param string $token
     * @return GameData[]
     */
    public function getGamesByToken(string $token) : array
    {
        return $this->repository->findGamesByToken($token);
    }

    /**
     * @param int $matchId
     * @return string
     */
    public function deleteGameById(int $matchId) : string
    {
        return $this->repository->deleteById($matchId);
    }
}