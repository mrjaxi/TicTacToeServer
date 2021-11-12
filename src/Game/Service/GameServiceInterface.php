<?php


namespace App\Game\Service;


use App\Game\Model\Game;

interface GameServiceInterface
{
    /**
     * @param $userid
     * @return Game
     */
    public function getUserGames(int $userid) : Game;

    /**
     * @param $userid
     * @param $relmatchid
     * @return bool
     */
    public function saveUserGame(int $userid, int $relmatchid) : bool;

    /**
     * @param $userid
     * @param $relmatchid
     * @return bool
     */
    public function updateUserGame(int $userid, int $relmatchid) : bool;
}