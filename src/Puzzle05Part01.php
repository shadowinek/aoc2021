<?php

namespace Shadowinek\Aoc2021;

class Puzzle05Part01 extends AbstractPuzzle
{
    public function run(): int
    {
        $diagram = [];

        foreach ($this->data as $entry) {
            $coords = explode(' -> ', $entry);
            list($x1, $y1) = explode(',', $coords[0]);
            list($x2, $y2) = explode(',', $coords[1]);

            if ($x1 === $x2) {
                if ($y1 > $y2) {
                    for ($a=$y2;$a<=$y1;$a++) {
                        if (isset($diagram[$x1 . '-' . $a])) {
                            $diagram[$x1 . '-' . $a]++;
                        } else {
                            $diagram[$x1 . '-' . $a] = 1;
                        }
                    }
                } else {
                    for ($a=$y1;$a<=$y2;$a++) {
                        if (isset($diagram[$x1 . '-' . $a])) {
                            $diagram[$x1 . '-' . $a]++;
                        } else {
                            $diagram[$x1 . '-' . $a] = 1;
                        }
                    }
                }
            } elseif ($y1 === $y2) {
                if ($x1 > $x2) {
                    for ($a=$x2;$a<=$x1;$a++) {
                        if (isset($diagram[$a . '-' . $y1])) {
                            $diagram[$a . '-' . $y1]++;
                        } else {
                            $diagram[$a . '-' . $y1] = 1;
                        }
                    }
                } else {
                    for ($a=$x1;$a<=$x2;$a++) {
                        if (isset($diagram[$a . '-' . $y1])) {
                            $diagram[$a . '-' . $y1]++;
                        } else {
                            $diagram[$a . '-' . $y1] = 1;
                        }
                    }
                }
            }
        }

        $diagram = array_filter($diagram, 'self::filter');

        return count($diagram);
    }

    protected function filter(int $value): bool
    {
        return $value > 1;
    }
}
