<?php

namespace Shadowinek\Aoc2021;

class Puzzle06Part02 extends Puzzle06Part01
{
    protected int $days = 256;

    /* Alternative stolen solution
    public function run(): int
    {
        $fishes = explode(',', $this->data[0]);
        $states = array_fill(0, self::NEW_BORN_CYCLE, 0);

        foreach ($fishes as $fish) {
            $states[$fish]++;
        }

        for ($i=0;$i<$this->days;$i++) {
            $memory = $states[0];

            $states[0] = $states[1];
            $states[1] = $states[2];
            $states[2] = $states[3];
            $states[3] = $states[4];
            $states[4] = $states[5];
            $states[5] = $states[6];
            $states[6] = $states[7] + $memory;
            $states[7] = $states[8];
            $states[8] = $memory;
        }

        return array_sum($states);
    }*/
}
