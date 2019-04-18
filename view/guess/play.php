<?php

namespace Anax\View;

/**
 * Render content within an article.
 */
//echo showEnvironment(get_defined_vars(), get_defined_functions());

?>

<div class="gameWrapper">
    <h1>Guess the number</h1>

    <p>Guess a number between 1 and 100, you have <?= $tries ?> tries left.</p>

    <form method="post">
        <input type="text" name="guess"  placeholder="Input a number" />
        <input type="submit" name="doGuess" value="Guess" />
        <input type="submit" name="doInit" value="Restart" />
        <input type="submit" name="doCheat" value="Cheat" />
    </form>

    <?php if ($error) : ?>
        <p>Error: <b><?= $error ?></b></p>
    <?php endif; ?>

    <?php if ($res && !$error) : ?>
        <p>Your guess <?= $guess ?> is <b><?= $res ?></b></p>
    <?php endif; ?>

    <?php if ($doCheat) : ?>
        <p>Cheat: Current number is <?= $number ?>.</p>
    <?php endif; ?>
</div>
