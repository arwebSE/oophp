<?php

namespace Anax\View;

/**
 * Render content within an article.
 */
//echo showEnvironment(get_defined_vars(), get_defined_functions());

?>
</main></div><!-- close parent -->

<link rel="stylesheet" href="../css/dice.css" />

<div class="row">
    <div class="region-flash">
        <img src="http://oophp/me/redovisa/htdocs/image/theme/arbanner.png?width=980&amp;height=200&amp;crop-to-fit&amp;area=0,0,0,0">
    </div>
</div>

<div class="row">

    <div class="wrap-sidebar region-sidebar-left has-sidebar-left has-sidebar" role="complementary">
        <div class="block toc">
            <h4>Info</h4>
            <?php
            if ($game->lastRoll) {
                echo 'Last throw (' . $game->lastRoll[0] . '):';
                $i = 0;
                $res = "";
                foreach ($game->lastRoll as $roll) {
                    if ($i > 0) {
                        $res .= $roll . ", ";
                    }
                    $i++;
                }
                echo substr($res, 0, -2); // remove comma and space
            }
            ?>
            <h3>Current Score</h3>
            Player: <?= $game->getPlayerScore() ?><br>
            PC: <?= $game->getPCScore() ?><br>

            <?php
            if ($game->pcHistory) {
                $res = "<h3>PC Dice History:</h3>";
                foreach ($game->pcHistory as $hand) {
                    $break = false;
                    foreach ($hand as $dice) {
                        if ($dice == "break") {
                            $break = true;
                        } else {
                            $res .= '<i class="dice-sprite dice-' . $dice . '"></i>';
                        }
                    }
                    if ($break) {
                        $res .= '<br><br>';
                    } else {
                        $res .= '<br>';
                    }
                }
                echo $res;
            }
            ?>

            <?php
            if ($game->playerHistory) {
                $res = "<h3>Player Dice History:</h3>";
                foreach ($game->playerHistory as $hand) {
                    $break = false;
                    foreach ($hand as $dice) {
                        if ($dice == "break") {
                            $break = true;
                        } else {
                            $res .= '<i class="dice-sprite dice-' . $dice . '"></i>';
                        }
                    }
                    if ($break) {
                        $res .= '<br><br>';
                    } else {
                        $res .= '<br>';
                    }
                }
                echo $res;
            }
            ?>
        </div>
    </div>

    <main class="region-main has-sidebar-left has-sidebar" role="main">
        <article class="article">
            <h1>Dice100</h1>

            <p><?= $game->status ?></p>

            <form method="post">
                <input type="submit" name="doRoll" value="Roll" <?= $game->disableBtn[0] ?> />
                <input type="submit" name="doSave" value="Save" <?= $game->disableBtn[1] ?> />
                <input type="submit" name="doRestart" value="Restart"/>
            </form>

            <?php if ($game->error) : ?>
                <p>Error: <b><?= $game->error ?></b></p>
            <?php endif; ?>

            <?php if ($game->playerDices) : ?>
            <h3>Player</h3>
            <p>
                <?php foreach ($game->playerDices as $dice) : ?>
                <i class="dice-sprite <?= $dice ?>"></i>
                <?php endforeach; ?>
            </p>
            <?php endif; ?>

            <?php if ($game->pcDices) : ?>
            <h3>PC</h3>
            <p>
                <?php foreach ($game->pcDices as $dice) : ?>
                <i class="dice-sprite <?= $dice ?>"></i>
                <?php endforeach; ?>
            </p>
            <?php endif; ?>

        </article>
    </main>

</div>
