<?php


namespace App\Game\Repository;

use App\Game\Model\Game;

interface GameRepositoryInterface
{
    /**
     * @param $id int
     * @return Game
     */
    public function findById($id) : Game;

    /**
     * @param $id int
     * @return Game
     */
    public function findByUserId($id) : Game;

    /**
     * @param $id int
     * @return Game
     */
    public function findByGameDataId($id) : Game;

    /**
     * @param Game $game
     * @return Game
     */
    public function save(Game $game) : Game;

    /**
     * @param Game $game
     * @return Game
     */
    public function update(Game $game) : Game;
}