<?php

namespace Shadowinek\Aoc2021;

class Puzzle12Part01 extends AbstractPuzzle
{
    protected const START = 'start';
    protected const END = 'end';
    protected array $caves = [];

    public function run(): int
    {
        foreach ($this->data as $data) {
            list($a, $b) = explode('-', $data);

            if ($b === self::START || $a === self::END) {
                $this->caves[$b][] = $a;
            } elseif ($a === self::START || $b === self::END) {
                $this->caves[$a][] = $b;
            } else {
                $this->caves[$a][] = $b;
                $this->caves[$b][] = $a;
            }
        }

        $routes = [];
        $finishes_routes = [];

        foreach ($this->caves[self::START] as $point) {
            $route = [self::START];
            $route[] = $point;
            $routes[] = $route;

            while (!empty($routes)) {
                $current = array_shift($routes);
                $last = end($current);

                foreach ($this->caves[$last] as $connection) {
                    if ($connection === self::END) {
                        $finishes_routes[] = array_merge($current, [$connection]);
                    } elseif ($this->isSmallCave($connection) && !$this->canVisit($current, $connection)) {
                        // skip;
                    } else {
                        $routes[] = array_merge($current, [$connection]);
                    }
                }
            }
        }

        return count($finishes_routes);
    }

    protected function isSmallCave(string $cave): bool
    {
        return ctype_lower($cave);
    }

    protected function canVisit(array $visited, string $cave): bool
    {
        return !in_array($cave, $visited);
    }
}

