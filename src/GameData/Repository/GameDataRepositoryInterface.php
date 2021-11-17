<?php


namespace App\GameData\Repository;


use App\GameData\Model\GameData;

interface GameDataRepositoryInterface
{
    /**
     * @return GameData[]
     */
    public function all() : array;

    /**
     * @param int $id
     * @return GameData
     */
    public function oneById(int $id) : GameData;

    /**
     * @param string $token
     * @return GameData[]
     */
    public function findGamesByToken(string $token) : array;

    /**
     * @param GameData $gamedata
     * @return GameData
     */
    public function save(GameData $gamedata) : GameData;

    /**
     * @param GameData $gamedata
     * @return GameData
     */
    public function update(GameData $gamedata) : GameData;
}