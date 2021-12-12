<?php

namespace Shadowinek\Aoc2021;

class Puzzle11Part02 extends Puzzle11Part01
{
    public function run(): int
    {
        $octopuses = [];

        foreach ($this->data as $row => $row_data) {
            foreach (str_split($row_data) as $column => $power) {
                $octopuses[$row . '-' . $column] = (int) $power;
            }
        }

        $i = 1;
        while($i < 1000) {
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

            if (count($flashed) === count($octopuses)) {
                return $i;
            }

            foreach ($flashed as $current) {
                $octopuses[$current] = 0;
            }

            $i++;
        }
    }
}
