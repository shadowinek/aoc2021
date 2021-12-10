<?php

namespace Shadowinek\Aoc2021;

class Puzzle10Part01 extends AbstractPuzzle
{
    protected const OPEN_A = '(';
    protected const OPEN_B = '[';
    protected const OPEN_C = '{';
    protected const OPEN_D = '<';

    protected const CLOSE_A = ')';
    protected const CLOSE_B = ']';
    protected const CLOSE_C = '}';
    protected const CLOSE_D = '>';

    protected array $pairs = [
        self::CLOSE_A => self::OPEN_A,
        self::CLOSE_B => self::OPEN_B,
        self::CLOSE_C => self::OPEN_C,
        self::CLOSE_D => self::OPEN_D,
    ];

    protected array $values = [
        self::CLOSE_A => 3,
        self::CLOSE_B => 57,
        self::CLOSE_C => 1197,
        self::CLOSE_D => 25137,
    ];

    public function run(): int
    {
        $value = 0;

        foreach ($this->data as $input) {
            $invalid = $this->findInvalid($input);
            if ($invalid) {
                $value += $this->values[$invalid];
            }
        }

        return $value;
    }

    protected function findInvalid(string $input): string
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
                        return $char;
                    }
                    break;
                default:
                    break;
            }
        }

        return false;
    }
}
