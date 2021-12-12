<?php

namespace Shadowinek\Aoc2021;

class Puzzle12Part02 extends Puzzle12Part01
{
    protected function canVisit(array $visited, string $cave): bool
    {
        $small = array_count_values(array_filter($visited, 'self::isSmallCave'));
        $twice = in_array(2, $small);

        if ($twice && !isset($small[$cave])) {
            return true;
        }

        if (!$twice) {
            return true;
        }

        return false;
    }
}

