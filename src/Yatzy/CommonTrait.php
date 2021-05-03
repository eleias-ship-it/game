<?php

declare(strict_types=1);

namespace elcl20\Yatzy;

/**
 * Trait Dice.
 */
trait CommonTrait
{
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

    public function arrayToHist($array): array
    {
        $histArray = [
            "1" => 0,
            "2" => 0,
            "3" => 0,
            "4" => 0,
            "5" => 0,
            "6" => 0
        ];
        foreach ($array as $key => $value) {
            $histArray[$value] += 1;
        }

        return $histArray;
    }

    public function onlyN($histogram, $roll): int
    {
        return $histogram[(string)$roll] * $roll;
    }

    public function yatzy($histogram): int
    {
        $score = 0;
        foreach ($histogram as $key => $value) {
            if ($value == 5 ) {
                $score = $value * $key;
            }
        }
        return $score;
    }

    public function chance($histogram): int
    {
        $score = 0;
        foreach ($histogram as $key => $value) {
            $score += $value * ($key);
        }
        return $score;
    }

    public function onePair($histogram): int
    {
        $score = 0;
        foreach ($histogram as $key => $value) {
            if ($value == 2 && ($value * $key > $score)) {
                $score = $value * $key;
            }

            if ($value == 3 && ($value * $key > $score)) {
                $score = ($value - 1) * $key;
            }

            if ($value == 4 && ($value * $key > $score)) {
                $score = ($value - 2) * $key;
            }

            if ($value == 5 && ($value * $key > $score)) {
                $score = ($value - 3) * $key;
            }
        }
        return $score;
    }

    public function twoPair($rollsHistogram): int
    {
        $firstPair = 0;
        $secondPair = 0;

        foreach ($rollsHistogram as $key => $value) {
            // echo $key . $value . "<br>";
            if ($value >= 2 && $firstPair == 0) {
                $firstPair = $key;
            }

            if ($value >= 2 && $key != $firstPair) {
                $secondPair = $key;
            }
        }
        return $firstPair * 2 + $secondPair * 2;
    }

    public function threes($rollsHistogram): int
    {
        $score = 0;
        foreach ($rollsHistogram as $key => $value) {
            if ($value >= 3) {
                $score = $key * 3;
            }
        }
        return $score;
    }

    public function fourths($rollsHistogram): int
    {
        $score = 0;
        foreach ($rollsHistogram as $key => $value) {
            if ($value >= 4) {
                $score = (integer)$key * 4;
            }
        }
        return $score;
    }

    public function smallLadder($rollsHistogram): int
    {
        $score = 0;
        if ($rollsHistogram[1] == 1
            && $rollsHistogram[2] == 1
            && $rollsHistogram[3] == 1
            && $rollsHistogram[4] == 1
            && $rollsHistogram[5] == 1
        ) {
            $score = 15;
        }
        return $score;
    }

    public function bigLadder($rollsHistogram): int
    {
        // var_dump($rollsHistogram);
        $score = 0;
        if ($rollsHistogram[2] == 1
            && $rollsHistogram[3] == 1
            && $rollsHistogram[4] == 1
            && $rollsHistogram[5] == 1
            && $rollsHistogram[6] == 1
        ) {
            $score = 20;
        }
        return $score;
    }

    public function fullHouse($rollsHistogram): int
    {
        $pair = 0;
        $threes = 0;

        foreach ($rollsHistogram as $key => $value) {
            if ($value == 2) {
                $pair = $key;
            }

            if ($value == 3) {
                $threes = $key;
            }
        }

        return $pair * 2 + $threes * 3;
    }
}
