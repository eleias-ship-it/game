<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);


?><h1><?= $header ?></h1>

<p><?= $message ?></p>

<p>DICE !</p>

<p><?= $dieLastRoll ?></p>

<p>DiceHand: </p>

<p><?= $diceHandRoll ?></p>

<p>DiceHand 1: </p>

<p><?= $diceHandRoll1 ?></p>


<p><?= $lastRollSide ?></p>

<form class="" action="/roll" method="post">
    <input type="hidden" name="" value="1">
    <button type="button" name="button">Roll one dice</button>
</form>

<form class="" action="/roll" method="post">
    <input type="hidden" name="" value="2">
    <button type="button" name="button">Roll two dices</button>
</form>
