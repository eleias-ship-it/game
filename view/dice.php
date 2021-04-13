<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

?><div class="container">
    <div class="header-game">
        <h1><?= $header ?></h1>

        <p><?= $message ?></p>
    </div>

    <div class="score">
        <p>Human Score: <?= $_SESSION["scoreHuman"] ?></p>
        <p>Computer Score: <?= $_SESSION["scoreComputer"] ?></p>
    </div>


    <p>Current Score: </p>

    <p><?= $sum ?></p>

    <div class="<?= $buttonArea?>">
        <form class="<?= $buttonArea ?>" action="roll1" method="POST">
            <input type="hidden" name="roll" value="1">
            <button type="submit" name="button">Roll one dice</button>
        </form>

        <form class="<?= $buttonArea ?>" action="roll2" method="POST">
            <input type="hidden" name="roll" value="2">
            <button type="submit" name="button">Roll two dices</button>
        </form>

        <form class="<?= $buttonArea ?>" action="stay" method="POST">
            <input type="hidden" name="roll" value="2">
            <button type="submit" name="button">stay</button>
        </form>
    </div>

    <div class="<?= $diceArea ?>">
        <p><?= $lastRollSide ?></p>
        <p><?= $HandGraph0 ?></p>
        <p><?= $HandGraph1 ?></p>

    </div>

    <p>Computer rolled: </p>
    <p><?= $computerSum?></p>

    <div class="<?= $endScreen ?>">
        <p><?= $gameOver ?></p>
    </div>

    <div class="<?= $playButton ?>">
        <form class="<?= $playButton ?>" action="replay" method="POST">
            <input type="hidden" name="roll" value="2">
            <button type="submit" name="button">Replay</button>
        </form>
    </div>

</div>
