<?php

namespace Shadowinek\Aoc2021;

class Puzzle09Part02 extends AbstractPuzzle
{
    public function run(): int
    {
        $map = [];

        foreach ($this->data as $x => $input) {
            $numbers = str_split($input);

            foreach ($numbers as $y => $number) {
                $map[$x][$y] = (int) $number;
            }
        }

        $numbers = [];
        $coords_map = [];

        foreach ($map as $row => $row_data) {
            foreach ($row_data as $column => $digit) {
                if ($map[$row][$column] === 9) {
                    $map[$row][$column] = false;

                } else {
                    $number = [];

                    if (isset($map[$row-1][$column]) && $map[$row-1][$column] !== false && $map[$row-1][$column] !== 9) {
                        $number[] = $row-1 . '-' . $column;
                    }

                    if (isset($map[$row][$column-1]) && $map[$row][$column-1] !== false && $map[$row][$column-1] !== 9) {
                        $number[] = $row . '-' . $column-1;
                    }

                    if (isset($map[$row+1][$column]) && $map[$row+1][$column] !== false && $map[$row+1][$column] !== 9) {
                        $number[] = $row+1 . '-' . $column;
                    }

                    if (isset($map[$row][$column+1]) && $map[$row][$column+1] !== false && $map[$row][$column+1] !== 9) {
                        $number[] = $row . '-' . $column+1;
                    }

                    $numbers[$row . '-' . $column] = $number;
                    $coords_map[] = $row . '-' . $column;
                }
            }
        }

        $basins = [];
        $i = 0;
        while (!empty($coords_map)) {
            $coords = array_shift($coords_map);
            $basins[$i] = 1;
            $connections = $numbers[$coords];
            $coords_map = array_diff($coords_map, [$coords]);

            while (!empty($connections)) {
                $connection = array_shift($connections);
                $coords_map = array_diff($coords_map, [$connection]);
                $basins[$i]++;
                $connections = array_unique(array_merge($connections, array_intersect($coords_map, $numbers[$connection])));
            }
            $i++;
        }

        rsort($basins);

        return $basins[0] * $basins[1] * $basins[2];
    }
}
