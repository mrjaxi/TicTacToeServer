<?php


namespace App\GameData\Model;


class GameData
{
    private $matchID;
    private $bot;
    private $winner;
    private $leftState;
    private $rightState;
    private $imagesID;
    private $date;

    /**
     * GameData constructor.
     * @param $matchID
     * @param $bot
     * @param $winner
     * @param $leftState
     * @param $rightState
     * @param $imagesID
     * @param $date
     */
    public function __construct($matchID, $bot, $winner, $leftState, $rightState, $imagesID, $date)
    {
        $this->matchID = $matchID;
        $this->bot = $bot;
        $this->winner = $winner;
        $this->leftState = $leftState;
        $this->rightState = $rightState;
        $this->imagesID = $imagesID;
        $this->date = $date;
    }


}