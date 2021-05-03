<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

// var_dump($gameData);
// var_dump($playerSettings);
?>
<div class="container">
    <div class="header-game">
        <h1><?= $header ?></h1>

        <!-- <p><?= $message ?></p> -->
    </div>
    <div class="game">
        <div class="dice-area-yatzy">
            <p>Current Player: <?= $gameData->getCurrentPlayer() ?></p>

            <p>Game message: <?=$message  ?></p>

            <div class="graph-dices">
                <?php foreach ($lastThrowGraphical as $key => $value) { ?>
                    <form class="" action="save" method="post">
                        <input type="hidden" name="dice" value="<?= $key ?>">
                        <button class="dice-button" type="submit"><?=$value ?></button>
                    </form>
                <?php } ?>
            </div>

            <div class="buttons-box">
                <form class="" action="throw" method="post">
                    <input type="hidden" name="" value="throw">
                    <button class="button" type="submit" name="button">throw</button>
                </form>
            </div>
        </div>

        <div class="table-container">
            <table class="table">
                <tr>
                    <th>Choices</th>
                    <th>Strike</th>
                    <?php foreach ($players as $key => $value) {?>
                        <th><?=$value->getName(); ?></th>
                    <?php } ?>
                </tr>
                <?php foreach ($players[$currentPlayerInt]->getScore() as $key => $value) {?>
                    <tr>
                        <td>
                            <form action="score" method="post">
                                <input type="hidden" name="choice" value="<?= $key ?>">
                                <button class="score-button" type="<?= $throw ?>" name="button"><?= $key ?></button>
                            </form>
                        </td>
                        <td>
                            <form class="" action="score" method="post">
                                <input type="hidden" name="choice" value="pass <?= $key ?>">
                                <button class="score-button" type="<?= $throw ?>" name="button">Pass</button>
                            </form>
                        </td>

                        <?php foreach ($players as $k => $v) {?>
                            <td>
                                <?=$v->getScore()[$key]; ?>
                            </td>

                        <?php } ?>
                    </tr>
                <?php } ?>

            </table>
        </div>
    </div>
</div>
