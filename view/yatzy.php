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

    <div class="">
        <form class="form-yatzy" action="startYatzy" method="POST">
            <label for="players">Number of human players</label>
            <input type="number" name="players" value="1">

            <label for="bots">Number of bots</label>
            <input type="number" name="bots" value="">
            <button class="button" type="submit" name="button">Play</button>
        </form>
    </div>
</div>
