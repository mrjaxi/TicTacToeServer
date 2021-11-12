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
     * @return bool
     */
    public function createGameData($bot, $winner, $leftState, $rightState, $imagesid, $date): bool
    {
        if (!isset($bot, $winner, $leftState, $rightState, $imagesid, $date)){
            return false;
        } else {
            $gamedata = new GameData($bot, $winner, $leftState, $rightState, $imagesid, $date);
            $this->repository->save($gamedata);

            return true;
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