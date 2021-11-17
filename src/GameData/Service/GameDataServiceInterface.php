<?php
namespace App\GameData\Service;

use App\GameData\Model\GameData;

interface GameDataServiceInterface
{
    /**
     * @param bool $bot
     * @param bool $winner
     * @param string $leftState
     * @param string $rightState
     * @param array $imagesid
     * @param string $date
     * @return GameData
     */
    public function createGameData(bool $bot, bool $winner, string $leftState, string $rightState, array $imagesid, string $date) : GameData;

    /**
     * @param int $id
     * @return GameData
     */
    public function getGameById(int $id) : GameData;

    /**
     * @param string $token
     * @return GameData[]
     */
    public function getGamesByToken(string $token) : array;

    /**
     * @return array
     */
    public function getGamesData() : array;
}