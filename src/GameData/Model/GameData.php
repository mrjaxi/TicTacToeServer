<?php


namespace App\GameData\Model;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class GameData
 * @package App\GameData\Model
 * @ORM\Entity()
 */
class GameData
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $matchid;

    /**
     * @var boolean
     * @ORM\Column(type="boolean")
     */
    private $bot;

    /**
     * @var boolean
     * @ORM\Column(type="boolean")
     */
    private $winner;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $leftState;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $rightState;

    /**
     * @var array
     * @ORM\Column(type="json")
     */
    private $imagesid;

    /**
     * @var DateTime
     * @ORM\Column(type="time")
     */
    private $date;

    /**
     * GameData constructor.
     * @param $bot
     * @param $winner
     * @param $leftState
     * @param $rightState
     * @param $imagesid
     * @param $date
     */
    public function __construct($bot, $winner, $leftState, $rightState, $imagesid, $date)
    {
        $this->bot = $bot;
        $this->winner = $winner;
        $this->leftState = $leftState;
        $this->rightState = $rightState;
        $this->imagesid = $imagesid;
        $this->date = $date;
    }

    /**
     * @return int
     */
    public function getMatchid(): int
    {
        return $this->matchid;
    }

    /**
     * @return bool
     */
    public function isBot(): bool
    {
        return $this->bot;
    }

    /**
     * @param bool $bot
     */
    public function setBot(bool $bot): void
    {
        $this->bot = $bot;
    }

    /**
     * @return bool
     */
    public function isWinner(): bool
    {
        return $this->winner;
    }

    /**
     * @param bool $winner
     */
    public function setWinner(bool $winner): void
    {
        $this->winner = $winner;
    }

    /**
     * @return string
     */
    public function getLeftState(): string
    {
        return $this->leftState;
    }

    /**
     * @param string $leftState
     */
    public function setLeftState(string $leftState): void
    {
        $this->leftState = $leftState;
    }

    /**
     * @return string
     */
    public function getRightState(): string
    {
        return $this->rightState;
    }

    /**
     * @param string $rightState
     */
    public function setRightState(string $rightState): void
    {
        $this->rightState = $rightState;
    }

    /**
     * @return array
     */
    public function getImagesid(): array
    {
        return $this->imagesid;
    }

    /**
     * @param array $imagesid
     */
    public function setImagesid(array $imagesid): void
    {
        $this->imagesid = $imagesid;
    }

    /**
     * @return DateTime
     */
    public function getDate(): DateTime
    {
        return $this->date;
    }

    /**
     * @param DateTime $date
     */
    public function setDate(DateTime $date): void
    {
        $this->date = $date;
    }
}