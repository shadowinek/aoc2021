<?php

namespace Shadowinek\Aoc2021;

class Puzzle10Part02 extends Puzzle10Part01
{
    protected array $reverse_pairs = [
        self::OPEN_A => self::CLOSE_A,
        self::OPEN_B => self::CLOSE_B,
        self::OPEN_C => self::CLOSE_C,
        self::OPEN_D => self::CLOSE_D,
    ];

    protected array $values = [
        self::CLOSE_A => 1,
        self::CLOSE_B => 2,
        self::CLOSE_C => 3,
        self::CLOSE_D => 4,
    ];

    public function run(): int
    {
        $values = [];

        foreach ($this->data as $input) {
            $queue = $this->findQueue($input);

            if ($queue) {
                $values[] = $this->calculateClosingValue($queue);
            }
        }

        sort($values);
        $index = floor(count($values) / 2);

        return $values[$index];
    }

    protected function findQueue(string $input): array|bool
    {
        $chars = str_split($input);
        $queue = [];

        foreach ($chars as $char) {
            switch ($char) {
                case self::OPEN_A:
                case self::OPEN_B:
                case self::OPEN_C:
                case self::OPEN_D:
                    $queue[] = $char;
                    break;
                case self::CLOSE_A:
                case self::CLOSE_B:
                case self::CLOSE_C:
                case self::CLOSE_D:
                    $last = $queue[count($queue)-1];
                    if ($this->pairs[$char] === $last) {
                        array_pop($queue);
                    } else {
                        return false;
                    }
                    break;
                default:
                    break;
            }
        }

        return $queue;
    }

    protected function calculateClosingValue(array $queue): int
    {
        $value = 0;

        foreach (array_reverse($queue) as $char) {
            $value = $value * 5 + $this->values[$this->reverse_pairs[$char]];
        }

        return $value;
    }
}
