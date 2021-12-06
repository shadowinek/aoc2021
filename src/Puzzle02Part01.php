<?php

namespace Shadowinek\Aoc2021;

class Puzzle02Part01 extends AbstractPuzzle
{
    public function run(): int
    {
        $horizontal = 0;
        $depth = 0;

        foreach ($this->data as $entry) {
            list($dir, $value) = explode(' ', $entry);

            switch ($dir) {
                case 'forward':
                    $horizontal += (int) $value;
                    break;
                case 'down':
                    $depth += (int) $value;
                    break;
                case 'up':
                    $depth -= (int) $value;
                    break;
                default:
                    break;
            }
        }

        return $horizontal * $depth;
    }
}
