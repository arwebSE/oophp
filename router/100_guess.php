<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));

/**
 * Init the game and redirect to play the game.
 */
$app->router->get("guess/init", function () use ($app) {
    $_SESSION["game"] = new ARWeb\Guess\Guess();
    $new = new ARWeb\Guess\Guess();
    $app->session->set("game", $new);
    $game = $app->session->get("game");
    return $app->response->redirect("guess/play");
});

/**
 * Play the game - show game status.
 */
$app->router->get("guess/play", function () use ($app) {
    $title = "Play the game";

    // Pass session data to var
    $game = $_SESSION["game"];

    $tries = $game->tries() ?? null;
    $number = $game->number() ?? null;
    $res = $_SESSION["res"] ?? null;
    $guess = $_SESSION["guess"] ?? null;
    $doCheat = $_SESSION["doCheat"] ?? null;

    $_SESSION["res"] = null;
    $_SESSION["guess"] = null;

    $data = [
        "guess" => $guess ?? null,
        "tries" => $tries,
        "number" => $number ?? null,
        "res" => $res,
        "doGuess" => $doGuess ?? null,
        "doCheat" => $doCheat ?? null,
        "error" => $error ?? null
    ];

    $app->page->add("guess/play", $data);
    //$app->page->add("guess/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});

/**
 * Play the game - make a guess.
 */
$app->router->post("guess/play", function () use ($app) {
    $title = "Play the game";

    // POST vars
    $guess = $_POST["guess"] ?? null;
    $doInit = $_POST["doInit"] ?? null;
    $doGuess = $_POST["doGuess"] ?? null;
    $doCheat = $_POST["doCheat"] ?? null;

    // Pass session data to var
    $game = $_SESSION["game"];

    // Help vars
    $res = null;
    $error = null;

    if ($doGuess) {
        try {
            $res = $game->makeGuess((int)$guess);
            $_SESSION["guess"] = $guess;
            $_SESSION["res"] = $res;
        } catch (ARWeb\Guess\GuessException $e) {
            $error = "Guess is out of bounds.";
        }
    } elseif ($doInit) {
        return $app->response->redirect("guess/init");
    } elseif ($doCheat) {
        $_SESSION["doCheat"] = $doCheat;
    }

    return $app->response->redirect("guess/play");
});

// Fully destroy session
function destroySession()
{
    $_SESSION = [];
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
    }
    session_destroy();
}
