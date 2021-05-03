<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

// var_dump($gameData);
var_dump($finalScore);
?>
<div class="container">
    <div class="header-game">
        <h1><?= $header ?></h1>

    </div>
    <div class="game">
        <div class="dice-area-yatzy">
            <p>GAME OVER!</p>

            <p>Congratulations to the winner: <?= $winner ?></p>
        </div>

        <div class="table-container">
            <table class="table">
                <tr>
                    <th>Player Name</th>
                    <th>Final Score</th>
                </tr>
                <?php foreach ($finalScore as $name => $score) {?>
                    <tr>
                        <td>
                            <?= $name ?>
                        </td>
                        <td>
                            <?= $score ?>
                        </td>
                    </tr>
                <?php } ?>

            </table>
        </div>
    </div>
</div>
