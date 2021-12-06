<?php

namespace Shadowinek\Aoc2021;

class AoC
{
    private function readInput(int $puzzle, bool $real_input): array
    {
        return file(sprintf(__DIR__ . '/../data/puzzle_%s%s',  $this->getNumberString($puzzle), $real_input ? '' : '_test') , FILE_IGNORE_NEW_LINES);
    }

    private function getNumberString(string $number): string
    {
        return sprintf('%02d', $number);
    }

    public function execute(int $puzzle, int $part, bool $real_input): void
    {
        $data = $this->readInput($puzzle, $real_input);

        $puzzle = 'Shadowinek\\Aoc2021\\Puzzle' . $this->getNumberString($puzzle) . 'Part' . $this->getNumberString($part);

        echo 'Puzzle: ' . $this->getNumberString($puzzle) . PHP_EOL;
        echo 'Part: ' . $this->getNumberString($part) . PHP_EOL;
        echo 'Dataset: ' . ($real_input ? 'real' : 'test') . PHP_EOL;
        echo '===============' . PHP_EOL;
        echo 'Output: ' . (class_exists($puzzle) ? (new $puzzle($data))->run() : 'This puzzle is not defined yet!') . PHP_EOL;
    }
}