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
     * @param $bot
     * @param $winner
     * @param $leftState
     * @param $rightState
     * @param $imagesid
     * @param $date
     * @return GameData
     */
    public function createGameData($bot, $winner, $leftState, $rightState, $imagesid, $date): GameData
    {
        if (!isset($bot, $winner, $leftState, $rightState, $imagesid, $date)){
            throw new \RuntimeException("Не все поля заполнены createGameData");
        } else {
            $gamedata = new GameData($bot, $winner, $leftState, $rightState, $imagesid, $date);
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
}