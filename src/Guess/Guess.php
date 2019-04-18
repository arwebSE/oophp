<?php

namespace ARWeb\Guess;

/**
 * Guess my number, a class supporting the game through GET, POST and SESSION.
 */
class Guess
{
    /**
     * @var int $number   The current secret number.
     * @var int $tries    Number of tries a guess has been made.
     * @var bool $gameover Decides whether game is over or not.
     */
    private $number;
    private $tries;
    private $gameover;

    /**
     * Constructor to initiate the object with current game settings,
     * if available. Randomize the current number if no value is sent in.
     *
     * @param int $number The current secret number, default -1 to initiate
     *                    the number from start.
     * @param int $tries  Number of tries a guess has been made,
     *                    default 6.
     */
    public function __construct(int $number = -1, int $tries = 6)
    {
        $this->gameover = false;
        $this->tries = $tries;
        $this->number = $number;
        if ($number < 0) {
            $this->random();
        }
    }

    /**
     * Randomize the secret number between 1 and 100 to initiate a new game.
     *
     * @return void
     */
    public function random()
    {
        $number = rand(1, 100);
        $this->number = $number;
    }

    /**
     * Get number of tries left.
     *
     * @return int as number of tries made.
     */
    public function tries()
    {
        return $this->tries;
    }

    /**
     * Get the secret number.
     *
     * @return int as the secret number.
     */
    public function number()
    {
        return $this->number;
    }


    /**
     * Ends the game.
     *
     * @return bool Returns true if game is over.
     */
    public function status()
    {
        return $this->gameover;
    }

    /**
     * Ends the game.
     *
     * @return void
     */
    public function endGame()
    {
        $this->gameover = true;
    }

    /**
     * Make a guess, decrease remaining guesses and return a string stating
     * if the guess was correct, too low or to high or if no guesses remains.
     *
     * @throws GuessException when guessed number is out of bounds.
     *
     * @return string to show the status of the guess made.
     */
    public function makeGuess($number)
    {
        if (!(is_int($number) && $number >= 0 && $number < 100)) {
            throw new GuessException();
        }
        if (!$this->status()) {
            if ($this->tries() >= 1) {
                if ($number < $this->number()) {
                    $this->tries = $this->tries() - 1;
                    return "TOO LOW";
                } elseif ($number > $this->number()) {
                    $this->tries = $this->tries() - 1;
                    return "TOO HIGH";
                }
                $this->endGame();
                return "CORRECT!";
            }
            $this->endGame();
            return "IRRELEVANT! You lost!";
        }
        return 'IRRELEVANT! Game is over!<br>Press "Restart" to play again.';
    }
}
