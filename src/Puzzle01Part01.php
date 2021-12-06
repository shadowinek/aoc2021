<?php

namespace Shadowinek\Aoc2021;

class Puzzle01Part01 extends AbstractPuzzle
{
    function run(): int
    {
        $increase = 0;
        $last = false;

        foreach ($this->data as $value) {
            if ($last) {
                if ($value > $last) {
                    $increase++;
                }
            }

            $last = $value;
        }

        return $increase;
    }
}