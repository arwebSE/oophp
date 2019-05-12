<?php

namespace ARWeb\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Dice.
 */
class DiceGameTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testCreateObject()
    {
        $game = new DiceGame();
        $this->assertInstanceOf("\ARWeb\Dice\DiceGame", $game);

        $res = $game->getPlayerScore();
        $exp = 0;
        $this->assertEquals($exp, $res);

        $res = $game->getPCScore();
        $exp = 0;
        $this->assertEquals($exp, $res);

        $res = $game->isGameOver();
        $exp = false;
        $this->assertEquals($exp, $res);
    }

    public function testSetGameOver()
    {
        $game = new DiceGame();

        $res = $game->isGameOver();
        $exp = false;
        $this->assertEquals($exp, $res);

        $game->setGameOver();

        $res = $game->isGameOver();
        $exp = true;
        $this->assertEquals($exp, $res);
    }

    public function testRollPlayer()
    {
        $game = new DiceGame();

        $res1 = $game->rollForPlayer();

        if (in_array(1, $game->lastRoll)) {
            $exp1 = true;
        } else {
            $exp1 = false;
        }

        $this->assertEquals($exp1, $res1);
    }

    public function testRollPC()
    {
        $game = new DiceGame();

        $game->rollForPC();

        $this->assertNotEquals($game->pcDices, null);
        $this->assertNotEquals($game->pcRolls, null);
    }

    public function testWinnerName()
    {
        $game = new DiceGame(true);

        $res1 = $game->winnerName();

        $this->assertEquals($res1, "Player");
    }

    public function testPlayerSave()
    {
        $game = new DiceGame(true);

        $game->playerSave();

        $res1 = $game->getPlayerScore();

        $this->assertEquals($res1, 169);
    }
}
