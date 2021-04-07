<?php

declare(strict_types=1);

namespace elcl20\Dice;

use function Mos\Functions\{
    destroySession,
    redirectTo,
    renderView,
    renderTwigView,
    sendResponse,
    url
};

/**
 * Class Dice.
 */
class GraphicalDice extends Dice
{
    private array $sides = [
        <<<EOT
        <div class="dices">
            <div class="dice one innergrid">
                <div class="dotone"></div>
            </div>
        </div>
        EOT,
        <<<EOT
        <div class="dices">
            <div class="dice two innergrid">
                <div class="dottwo1"></div>
                <div class="dottwo2"></div>
            </div>
        </div>
        EOT,
        <<<EOT
        <div class="dices">
            <div class="dice three innergrid">
                <div class="dotone"></div>
                <div class="dottwo1"></div>
                <div class="dottwo2"></div>
            </div>
        </div>
        EOT,
        <<<EOT
        <div class="dices">
            <div class="dice four innergrid">
                <div class="dottwo1"></div>
                <div class="dottwo2"></div>
                <div class="dotfour1"></div>
                <div class="dotfour2"></div>
            </div>
        </div>
        EOT,
        <<<EOT
        <div class="dices">
            <div class="dice five innergrid">
                <div class="dottwo1"></div>
                <div class="dottwo2"></div>
                <div class="dotfour1"></div>
                <div class="dotfour2"></div>
                <div class="dotone"></div>
            </div>
        </div>
        EOT,
        <<<EOT
        <div class="dices">
            <div class="dice six innergrid">
                <div class="dottwo1"></div>
                <div class="dottwo2"></div>
                <div class="dotfour1"></div>
                <div class="dotfour2"></div>
                <div class="dotsix1"></div>
                <div class="dotsix2"></div>
            </div>
        </div>
        EOT
    ];

    public function getSide($index): ?string
    {
        return $this->sides[$index];
    }
}
