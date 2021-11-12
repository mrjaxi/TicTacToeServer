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
     * @param $id int
     * @return GameData
     */
    public function oneById(int $id) : GameData;

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