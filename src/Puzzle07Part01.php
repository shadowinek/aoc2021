<?php

namespace Shadowinek\Aoc2021;

class Puzzle07Part01 extends AbstractPuzzle
{
    public function run(): int
    {
        $crabs = explode(',', $this->data[0]);
        $min = min($crabs);
        $max = max($crabs);

        $fuel = array_fill($min, $max+1, 0);

        for ($i=$min;$i<=$max;$i++) {
            foreach ($crabs as $crab) {
                $fuel[$i] += abs($crab - $i);
            }
        }

        return min($fuel);
    }
}
