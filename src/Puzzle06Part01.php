<?php

namespace Shadowinek\Aoc2021;

class Puzzle06Part01 extends AbstractPuzzle
{
    protected int $days = 80;
    protected const NEW_BORN_CYCLE = 9;
    protected const BORN_CYCLE = 7;

    public function run(): int
    {
        $fishes = explode(',', $this->data[0]);
        $fish_array = array_fill(0, $this->days, 0);

        foreach ($fishes as $fish) {
            $keys = $this->getArrayKeys((int) $fish);

            foreach ($keys as $key) {
                $fish_array[$key]++;
            }
        }

        for ($x=0;$x<$this->days-self::NEW_BORN_CYCLE;$x++) {
            if ($fish_array[$x] > 0) {
                $keys = $this->getArrayKeys( $x + self::NEW_BORN_CYCLE);
                foreach ($keys as $key) {
                    $fish_array[$key] += $fish_array[$x];
                }
            }
        }

        return count($fishes) + array_sum($fish_array);
    }

    private function getArrayKeys(int $start): array
    {
        $key = $start;
        $keys = [];
        $keys[] = $key;

        while ($key + self::BORN_CYCLE < $this->days) {
            $key += self::BORN_CYCLE;
            $keys[] = $key;
        }

        return $keys;
    }
}
