<?php


namespace App\GameData\Model;

use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Array_;

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
     * @ORM\Column(type="array")
     */
    private $imagesId;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $date;

    /**
     * @var int
     * @ORM\Column(name="userId",type="integer")
     */
    private $userId;

    /**
     * GameData constructor.
     * @param bool $bot
     * @param bool $winner
     * @param string $leftState
     * @param string $rightState
     * @param array $imagesId
     * @param string $date
     * @param int $userId
     */
    public function __construct(bool $bot = false, bool $winner = false,
                                string $leftState = "", string $rightState = "" ,
                                array $imagesId = array(), string $date = "", int $userId = 0)
    {
        $this->setBot($bot);
        $this->setWinner($winner);
        $this->setLeftState($leftState);
        $this->setRightState($rightState);
        $this->setImagesid($imagesId);
        $this->setDate($date);
        $this->setUserId($userId);
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
    public function getImagesId(): array
    {
        return $this->imagesId;
    }

    /**
     * @param array $imagesId
     */
    public function setImagesid(array $imagesId): void
    {
        $this->imagesId = $imagesId;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @param string $date
     */
    public function setDate(string $date): void
    {
        $this->date = $date;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     */
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }
}