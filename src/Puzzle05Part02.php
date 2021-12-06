<?php

namespace Shadowinek\Aoc2021;

class Puzzle05Part02 extends Puzzle05Part01
{
    function run(): int
    {
        $diagram = [];
        foreach ($this->data as $i => $entry) {
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
            } elseif (abs($x1-$x2) === abs($y1-$y2)) {
                $steps = abs($x1-$x2);

                if ($x1 > $x2) {
                    if ($y1 > $y2) {
                        for ($a=0;$a<=$steps;$a++) {
                            $diagram = $this->add($diagram, $x1 - $a . '-' . $y1 - $a);
                        }
                    } else {
                        for ($a=0;$a<=$steps;$a++) {
                            $diagram = $this->add($diagram, $x1 - $a . '-' . $y1 + $a);
                        }
                    }
                } else {
                    if ($y1 > $y2) {
                        for ($a=0;$a<=$steps;$a++) {
                            $diagram = $this->add($diagram, $x1 + $a . '-' . $y1 - $a);
                        }
                    } else {
                        for ($a=0;$a<=$steps;$a++) {
                            $diagram = $this->add($diagram, $x1 + $a . '-' . $y1 + $a);
                        }
                    }
                }
            }
        }

        $diagram = array_filter($diagram, 'self::filter');

        return count($diagram);
    }

    protected function add(array $diagram, string $key): array
    {
        if (isset($diagram[$key])) {
            $diagram[$key]++;
        } else {
            $diagram[$key] = 1;
        }

        return $diagram;
    }
}
