<?php

namespace Shadowinek\Aoc2021;

abstract class AbstractPuzzle
{
    protected array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    abstract public function run(): int;
}