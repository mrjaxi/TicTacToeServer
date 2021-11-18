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
     * @param int $userId
     * @return GameData
     */
    public function createGameData(bool $bot, bool $winner, string $leftState, string $rightState, array $imagesid, string $date,int $userId) : GameData;

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

    /**
     * @param int $matchId
     * @return string
     */
    public function deleteGameById(int $matchId) : string ;
}