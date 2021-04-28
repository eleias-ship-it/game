<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

var_dump($gameData);
?>
<div class="container">
    <div class="header-game">
        <h1><?= $header ?></h1>

        <p><?= $message ?></p>
    </div>

    <div class="dice-area">
        <p>Current Player: <?= $gameData->getCurrentPlayer() ?></p>
        <form class="" action="throw" method="post">
            <input type="hidden" name="" value="throw">
            <button class="button" type="submit" name="button">throw</button>
        </form>
    </div>

    <div class="table-container">
        <table class="table">
            <tr>
                <th>Choices</th>
                <?php foreach ($players as $key => $value) {?>
                    <th><?=$value->getName(); ?></th>
                <?php } ?>
            </tr>
            <?php foreach ($players[0]->getScore() as $key => $value) {?>
                <tr>
                    <td><?= $key ?></td>
                    <?php foreach ($players as $k => $v) {?>
                        <td><?=$v->getScore()[$key]; ?></td>
                    <?php } ?>
                </tr>
            <?php } ?>

        </table>
    </div>
</div>
