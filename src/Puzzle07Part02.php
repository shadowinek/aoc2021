<?php

namespace Shadowinek\Aoc2021;

class Puzzle07Part02 extends AbstractPuzzle
{
    public function run(): int
    {
        $crabs = explode(',', $this->data[0]);
        $min = min($crabs);
        $max = max($crabs);

        $fuel = array_fill($min, $max+1, 0);

        for ($i=$min;$i<=$max;$i++) {
            foreach ($crabs as $crab) {
                $change = abs($crab - $i);
                $change_array = array_fill(1, $change, 1);
                $fuel[$i] += array_sum(array_keys($change_array));
            }
        }

        return min($fuel);
    }
}
