<?php

namespace Shadowinek\Aoc2021;

class Puzzle03Part01 extends AbstractPuzzle
{
    function run(): int
    {
        $gamma = [];
        $epsilon = [];
        $length = 0;
        $count = [];

        foreach ($this->data as $entry) {
            $bits = str_split($entry);

            if (!$length) {
                $length = count($bits);
            }

            for ($i=0;$i<$length;$i++) {
                if (isset($count[$i][$bits[$i]])) {
                    $count[$i][$bits[$i]]++;
                } else {
                    $count[$i][$bits[$i]] = 1;
                }
            }
        }

        foreach ($count as $pos => $bit) {
            if ($bit[0] > $bit[1]) {
                $gamma[$pos] = 0;
                $epsilon[$pos] = 1;
            } else {
                $gamma[$pos] = 1;
                $epsilon[$pos] = 0;
            }
        }

        return bindec(implode($gamma)) * bindec(implode($epsilon));
    }
}
