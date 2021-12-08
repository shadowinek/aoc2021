<?php

namespace Shadowinek\Aoc2021;

class Puzzle08Part01 extends AbstractPuzzle
{
    public function run(): int
    {
        $count = 0;

        foreach ($this->data as $data) {
            $parts = explode( ' | ', $data);
            $output = explode(' ', $parts[1]);

            foreach ($output as $string) {
                switch (strlen($string)) {
                    case 2:
                    case 3:
                    case 4:
                    case 7:
                        $count++;
                        break;
                    default:
                        break;

                }
            }
        }

        return $count;
    }
}
