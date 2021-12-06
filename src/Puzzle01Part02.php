<?php

namespace Shadowinek\Aoc2021;

class Puzzle01Part02 extends AbstractPuzzle
{
    function run(): int
    {
        $sum_old = [];
        $increase = 0;

        foreach ($this->data as $value) {
            $sum_new = $sum_old;

            if (count($sum_new) === 3) {
                array_shift($sum_new);
            }

            $sum_new[] = $value;

            if (count($sum_old) === 3 && count($sum_new) === 3) {
                if (array_sum($sum_new) > array_sum($sum_old)) {
                    $increase++;
                }
            }

            $sum_old = $sum_new;
        }

        return $increase;
    }
}