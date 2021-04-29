<?php

declare(strict_types=1);

namespace elcl20\Yatzy;

/**
 * Trait Dice.
 */
trait CommonTrait {
    public function getGraphDiceSide($status): array
    {
        return [
            <<<EOT
            <div class="dices ">
                <div class="dice one innergrid {$status}">
                    <div class="dotone"></div>
                </div>
            </div>
            EOT,
            <<<EOT
            <div class="dices ">
                <div class="dice two innergrid {$status}">
                    <div class="dottwo1"></div>
                    <div class="dottwo2"></div>
                </div>
            </div>
            EOT,
            <<<EOT
            <div class="dices ">
                <div class="dice three innergrid {$status}">
                    <div class="dotone"></div>
                    <div class="dottwo1"></div>
                    <div class="dottwo2"></div>
                </div>
            </div>
            EOT,
            <<<EOT
            <div class="dices ">
                <div class="dice four innergrid {$status}">
                    <div class="dottwo1"></div>
                    <div class="dottwo2"></div>
                    <div class="dotfour1"></div>
                    <div class="dotfour2"></div>
                </div>
            </div>
            EOT,
            <<<EOT
            <div class="dices ">
                <div class="dice five innergrid {$status}">
                    <div class="dottwo1"></div>
                    <div class="dottwo2"></div>
                    <div class="dotfour1"></div>
                    <div class="dotfour2"></div>
                    <div class="dotone"></div>
                </div>
            </div>
            EOT,
            <<<EOT
            <div class="dices ">
                <div class="dice six innergrid {$status}">
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
    }
}
