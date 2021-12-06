<?php

namespace Shadowinek\Aoc2021;

class Puzzle03Part02 extends AbstractPuzzle
{
    function run(): int
    {
        $count = $this->findCommonBit($this->data, 0);
        $oxygen = $this->findValue($this->data, $count, 0, true);
        $co2 = $this->findValue($this->data, $count, 0, false);

        return bindec($oxygen[0]) * bindec($co2[0]);
    }

    private function findCommonBit(array $data, int $pos): array
    {
        $count = [];

        foreach ($data as $entry) {
            $bits = str_split($entry);

            if (isset($count[$bits[$pos]])) {
                $count[$bits[$pos]]++;
            } else {
                $count[$bits[$pos]] = 1;
            }
        }

        return $count;
    }

    private function findValue(array $data, array $count, int $pos, bool $most_common): array
    {
        $valid = [];
        $best = $count[0] > $count[1] ? 0 : 1;
        $best = $most_common ? $best : (int) !$best;

        foreach ($data as $entry) {
            $bits = str_split($entry);

            if ((int) $bits[$pos] === $best) {
                $valid[] = $entry;
            }
        }

        if (count($valid) > 1) {
            $pos++;
            return $this->findValue($valid, $this->findCommonBit($valid, $pos), $pos, $most_common);
        } else {
            return $valid;
        }
    }
}
