<?php


namespace App\Game\Service;


use App\Game\Model\Game;
use App\Game\Repository\GameRepositoryInterface;

class GameService implements GameServiceInterface
{
    private $repository;

    public function __construct(GameRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param $userid
     * @return Game
     */
    public function getUserGames(int $userid): Game
    {
        return $this->repository->findByUserId($userid);
    }

    /**
     * @param $userid
     * @param $relmatchid
     * @return bool
     */
    public function saveUserGame(int $userid, int $relmatchid): bool
    {
        if ($userid == null or $relmatchid == null){
            throw new \RuntimeException("Поля userID или matchID пусты");
        }

        $game = new Game($userid, $relmatchid);
        $this->repository->save($game);

        return true;
    }

    /**
     * @param $userid
     * @param $relmatchid
     * @return bool
     */
    public function updateUserGame(int $userid, int $relmatchid): bool
    {
        if ($userid == null or $relmatchid == null){
            throw new \RuntimeException("Поля userID или matchID пусты");
        }

        $game = new Game($userid, $relmatchid);
        $this->repository->update($game);

        return true;
    }
}