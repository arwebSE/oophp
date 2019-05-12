<?php
/**
 * Create routes using $app programming style.
 */

/**
 * Init the game and redirect to play the game.
 */
$app->router->get("dice/init", function () use ($app) {
    $newgame = new ARWeb\Dice\DiceGame();
    $app->session->set("dice100", $newgame);
    return $app->response->redirect("dice/play");
});

/**
 * Play the game GET.
 */
$app->router->get("dice/play", function () use ($app) {
    $title = "Play Dice100";

    // Pass session data to var
    $game = $app->session->get("dice100");
    $doRoll = $app->session->get("doRoll", null);
    $doSave = $app->session->get("doSave", null);
    $doRestart = $app->session->get("doRestart", null);

    if ($game->getPCScore() >= 100 || $game->getPlayerScore() >= 100) {
        $game->setGameOver();
        $game->status = "Game is over! " . $game->winnerName() . " won.";
        $game->disableBtn = ["disabled", "disabled"];
    }

    $data = [
        "game" => $game,
        "doRoll" => $doRoll,
        "doSave" => $doSave,
        "doRestart" => $doRestart
    ];

    $app->page->add("dice/play", $data);
    //$app->page->add("dice/debug", $data);

    return $app->page->render([
        "title" => $title
    ]);
});

/**
 * Play the game POST.
 */
$app->router->post("dice/play", function () use ($app) {
    // POST vars
    $doRoll = $app->request->getPost("doRoll", null);
    $doSave = $app->request->getPost("doSave", null);
    $doRestart = $app->request->getPost("doRestart", null);

    // Pass session data to var
    $game = $app->session->get("dice100");

    if ($doRestart) {
        return $app->response->redirect("dice/init");
    }
    if (!$game->isGameOver()) {
        if ($doRoll) {
            try {
                if ($game->rollForPlayer($game)) {
                    $game->pcRolls = 0;
                    $game->rollForPC($game);
                }
            } catch (ARWeb\Dice\DiceException $e) {
                $game->error = "Dice error.";
            }
        } elseif ($doSave) {
            $game->playerSave();
            $game->pcRolls = 0;
            $game->rollForPC($game);
            $game->disableBtn = ["", "disabled"];
        }
    }
    return $app->response->redirect("dice/play");
});
