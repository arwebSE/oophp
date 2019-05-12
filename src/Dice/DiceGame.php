<?php
namespace ARWeb\Dice;

/**
 * A dicehand, consisting of dices.
 */
class DiceGame
{
    /**
     * @var Dice $dices   Array consisting of dices.
     * @var int  $values  Array consisting of last roll of the dices.
     */
    private $hand;
    private $playerRoundScore;
    private $pcRoundScore;
    private $isGameOver; // needs get
    private $playerScore; // needs get
    private $pcScore; // needs get
    public $pcRolls;
    public $lastRoll;
    public $playerDices;
    public $pcDices;
    public $error;
    public $status;
    public $disableBtn;
    public $playerHistory;
    public $pcHistory;

    /**
     * Constructor to initiate the dicehand with a number of dices.
     *
     * @param int $dices Number of dices to create, defaults to five.
     */
    public function __construct($debug = false)
    {
        $this->hand = new DiceHand;
        $this->isGameOver = false;
        $this->status = "Game initiated. Press Roll to start.";
        $this->disableBtn = ["", "disabled"];
        $this->playerScore = 0;
        $this->pcScore = 0;
        $this->pcRolls = 0;
        $this->playerRoundScore = 0;
        $this->pcRoundScore = 0;
        $this->playerHistory = [];
        $this->pcHistory = [];
        if ($debug) {
            $this->playerScore = 100;
            $this->pcScore = 0;
            $this->playerRoundScore = 69;
            $this->playerHistory[0] = [6, 5];
        }
    }

    public function getPlayerScore()
    {
        return $this->playerScore;
    }

    public function getPCScore()
    {
        return $this->pcScore;
    }

    public function setGameOver()
    {
        $this->isGameOver = true;
    }

    public function isGameOver()
    {
        return $this->isGameOver;
    }

    public function rollForPlayer()
    {
        $this->hand->roll(); // roll
        $currRoll = $this->hand->values(); // save roll
        array_push($this->playerHistory, $currRoll); // add to dice history

        $this->playerDices = $this->hand->getGraphicDices(); // get & set printable values
        $this->lastRoll = $currRoll; // save curr roll to printable
        array_unshift($this->lastRoll, "Player"); // add print string

        if (in_array(1, $currRoll)) {
            if (sizeof($this->playerHistory) > 1) {
                $this->playerHistory[sizeof($this->playerHistory)-1][] = "break"; // to separate rounds
            } else {
                $this->playerHistory[0][] = "break";
            }
            // skip sum and roll for pc
            $this->playerRoundScore = 0;
            return true; // roll for pc
        } else {
            $this->status = "You rolled. You want to roll again or save?";
            $this->disableBtn = ["", ""];
            $this->playerRoundScore += array_sum($currRoll);
        }
        return false;
    }

    public function playerSave()
    {
        $this->playerScore += $this->playerRoundScore;
        if (sizeof($this->playerHistory) > 1) {
            $this->playerHistory[sizeof($this->playerHistory)-1][] = "break"; // to separate rounds
        } else {
            $this->playerHistory[0][] = "break";
        }
    }

    public function winnerName()
    {
        if ($this->pcScore > $this->playerScore) {
            return "PC";
        }
        return "Player";
    }

    public function rollForPC()
    {
        $this->hand->roll(); // do roll
        $currRoll = $this->hand->values(); // save roll
        array_push($this->pcHistory, $currRoll); // add to dice history

        $this->pcDices = $this->hand->getGraphicDices(); // fetch printable dices
        $this->lastRoll = $currRoll; // save roll to print var
        array_unshift($this->lastRoll, "PC"); // display only

        $this->pcRolls++; // just for counting iterations
        $this->pcRoundScore += array_sum($currRoll); // incrementing round score

        if (in_array(1, $currRoll)) { // pc lost, players turn
            if (sizeof($this->pcHistory) > 1) {
                $this->pcHistory[sizeof($this->pcHistory)-1][] = "break"; // to separate rounds
            } else {
                $this->pcHistory[0][] = "break";
            }
            $this->pcRoundScore = 0; // no points for pc
            if ($this->playerRoundScore == 0) {
                $this->status = "You lost the round,";
            } else {
                $this->status = "You saved,";
            } $this->status .= " and then PC lost its round after rolling " . $this->pcRolls. " time(s). Your turn.";
        } elseif (rand(0, 1)) { //randomly save for pc. 50%
            if (sizeof($this->pcHistory) > 1) {
                $this->pcHistory[sizeof($this->pcHistory)-1][] = "break"; // to separate rounds
            } else {
                $this->pcHistory[0][] = "break";
            }
            $this->pcScore += $this->pcRoundScore; // update total score
            if ($this->playerRoundScore == 0) {
                $this->status = "You lost the round,";
            } else {
                $this->status = "You saved,";
            } $this->status .= "  and PC saved after rolling " . $this->pcRolls . " time(s). Your turn.";
        } else {
            // pc not saving
            $this->rollForPC();
        }
    }
}
