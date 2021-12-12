<?php

namespace Shadowinek\Aoc2021;

class Puzzle11Part01 extends AbstractPuzzle
{
    protected int $steps = 100;

    public function run(): int
    {
        $octopuses = [];
        $total = 0;

        foreach ($this->data as $row => $row_data) {
            foreach (str_split($row_data) as $column => $power) {
                $octopuses[$row . '-' . $column] = (int) $power;
            }
        }

        for ($i=0;$i<$this->steps;$i++) {
            $octopuses = array_map('self::plus', $octopuses);
            $to_flash = array_keys(array_filter($octopuses, 'self::filter'));
            $flashed = [];

            while (!empty($to_flash)) {
                foreach ($to_flash as $current) {
                    list($row, $column) = explode('-', $current);
                    $row = (int) $row;
                    $column = (int) $column;

                    if (isset($octopuses[$row-1 . '-' . $column-1])) {
                        $octopuses[$row-1 . '-' . $column-1]++;
                    }

                    if (isset($octopuses[$row-1 . '-' . $column])) {
                        $octopuses[$row-1 . '-' . $column]++;
                    }

                    if (isset($octopuses[$row-1 . '-' . $column+1])) {
                        $octopuses[$row-1 . '-' . $column+1]++;
                    }

                    if (isset($octopuses[$row . '-' . $column-1])) {
                        $octopuses[$row . '-' . $column-1]++;
                    }

                    if (isset($octopuses[$row . '-' . $column+1])) {
                        $octopuses[$row . '-' . $column+1]++;
                    }

                    if (isset($octopuses[$row+1 . '-' . $column-1])) {
                        $octopuses[$row+1 . '-' . $column-1]++;
                    }

                    if (isset($octopuses[$row+1 . '-' . $column])) {
                        $octopuses[$row+1 . '-' . $column]++;
                    }

                    if (isset($octopuses[$row+1 . '-' . $column+1])) {
                        $octopuses[$row+1 . '-' . $column+1]++;
                    }

                    $flashed[] = $current;
                }

                $new_flash = array_keys(array_filter($octopuses, 'self::filter'));
                $to_flash = array_diff($new_flash, $flashed);
            }

            $total += count($flashed);
            foreach ($flashed as $current) {
                $octopuses[$current] = 0;
            }
        }

        return $total;
    }

    protected function plus(int $power): int
    {
        return $power + 1;
    }

    protected function filter(int $power): bool
    {
        return $power > 9;
    }
}
