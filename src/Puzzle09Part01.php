<?php

namespace Shadowinek\Aoc2021;

class Puzzle09Part01 extends AbstractPuzzle
{
    public function run(): int
    {
        $map = [];

        foreach ($this->data as $x => $input) {
            $numbers = str_split($input);

            foreach ($numbers as $y => $number) {
                $map[$x][$y] = $number;
            }
        }

        $low = [];

        foreach ($map as $row => $row_data) {
            foreach ($row_data as $column => $digit) {
                if (isset($map[$row-1][$column]) && $map[$row-1][$column] <= $digit) {
                    continue;
                }

                if (isset($map[$row][$column-1]) && $map[$row][$column-1] <= $digit) {
                    continue;
                }

                if (isset($map[$row+1][$column]) && $map[$row+1][$column] <= $digit) {
                    continue;
                }

                if (isset($map[$row][$column+1]) && $map[$row][$column+1] <= $digit) {
                    continue;
                }

                $low[] = $digit + 1;
            }
        }

        return array_sum($low);
    }
}
