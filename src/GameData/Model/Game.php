<?php


namespace App\GameData\Model;

/**
 * Class Game
 * @package App\GameData\Model
 * @ORM\Entity()
 */
class Game
{
    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $userID;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $matchID;

    /**
     * Game constructor.
     * @param $userID
     * @param $matchID
     */
    public function __construct($userID, $matchID)
    {
        $this->userID = $userID;
        $this->matchID = $matchID;
    }

    /**
     * @return mixed
     */
    public function getUserID()
    {
        return $this->userID;
    }

    /**
     * @return mixed
     */
    public function getMatchID()
    {
        return $this->matchID;
    }
}