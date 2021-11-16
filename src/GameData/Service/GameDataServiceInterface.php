<?php
namespace App\GameData\Service;

use App\GameData\Model\GameData;

interface GameDataServiceInterface
{
    /**
     * @param $bot
     * @param $winner
     * @param $leftState
     * @param $rightState
     * @param $imagesid
     * @param $date
     * @return GameData
     */
    public function createGameData($bot, $winner, $leftState, $rightState, $imagesid, $date) : GameData;

    /**
     * @param $id
     * @return GameData
     */
    public function getGameById($id) : GameData;

    /**
     * @return array
     */
    public function getGamesData() : array;
}