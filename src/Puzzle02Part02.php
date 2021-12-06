<?php

namespace Shadowinek\Aoc2021;

class Puzzle02Part02 extends AbstractPuzzle
{
    function run(): int
    {
        $horizontal = 0;
        $depth = 0;
        $aim = 0;

        foreach ($this->data as $entry) {
            list($dir, $value) = explode(' ', $entry);

            switch ($dir) {
                case 'forward':
                    $horizontal += (int) $value;
                    $depth += $aim * (int) $value;
                    break;
                case 'down':
                    $aim += (int) $value;
                    break;
                case 'up':
                    $aim -= (int) $value;
                    break;
                default:
                    break;
            }
        }

        return $horizontal * $depth;
    }
}
