<?php

namespace Shadowinek\Aoc2021;

class Puzzle08Part02 extends AbstractPuzzle
{
    private const SEGMENT_A = 'a';
    private const SEGMENT_B = 'b';
    private const SEGMENT_C = 'c';
    private const SEGMENT_D = 'd';
    private const SEGMENT_E = 'e';
    private const SEGMENT_F = 'f';
    private const SEGMENT_G = 'g';

    private const NUMBER_0 = 0;
    private const NUMBER_1 = 1;
    private const NUMBER_2 = 2;
    private const NUMBER_3 = 3;
    private const NUMBER_4 = 4;
    private const NUMBER_5 = 5;
    private const NUMBER_6 = 6;
    private const NUMBER_7 = 7;
    private const NUMBER_8 = 8;
    private const NUMBER_9 = 9;

    private array $segments = [
        self::SEGMENT_A,
        self::SEGMENT_B,
        self::SEGMENT_C,
        self::SEGMENT_D,
        self::SEGMENT_E,
        self::SEGMENT_F,
        self::SEGMENT_G,
    ];

    public function run(): int
    {
        $output = 0;

        foreach ($this->data as $data) {
            list($test, $input) = explode( ' | ', $data);
            $test_numbers = explode(' ', $test);
            $test_lengths = $this->getLengths($test_numbers);
            $input_numbers = explode(' ', $input);

            $coding = $this->parseOneAndSeven(str_split($test_lengths[2][0]), str_split($test_lengths[3][0]));
            $coding = $this->parseFour(str_split($test_lengths[4][0]), $coding);
            $coding = $this->parseEight(str_split($test_lengths[7][0]), $test_lengths[6], $coding);

            $results = [];

            foreach ($input_numbers as $input_number) {
                switch(strlen($input_number)) {
                    case 2:
                        $result = self::NUMBER_1;
                        break;
                    case 3:
                        $result = self::NUMBER_7;
                        break;
                    case 4:
                        $result = self::NUMBER_4;
                        break;
                    case 7:
                        $result = self::NUMBER_8;
                        break;
                    case 5:
                        $result = $this->findLengthFive($input_number, $coding);
                        break;
                    case 6:
                        $result = $this->findLengthSix($input_number, $coding);
                        break;
                    default:
                        break;
                }

                $results[] = $result;
            }

            $output += (int) implode($results);
        }

        return $output;
    }

    private function findLengthFive(string $input, array $coding): int
    {
        $chars = str_split($input);

        if (in_array($coding[self::SEGMENT_C], $chars) && in_array($coding[self::SEGMENT_E], $chars)) {
            return self::NUMBER_2;
        } elseif (in_array($coding[self::SEGMENT_C], $chars) && in_array($coding[self::SEGMENT_F], $chars)) {
            return self::NUMBER_3;
        } elseif (in_array($coding[self::SEGMENT_B], $chars) && in_array($coding[self::SEGMENT_F], $chars)) {
            return self::NUMBER_5;
        }
    }

    private function findLengthSix(string $input, array $coding): int
    {
        $chars = str_split($input);

        if (!in_array($coding[self::SEGMENT_D], $chars)) {
            return self::NUMBER_0;
        } elseif (!in_array($coding[self::SEGMENT_C], $chars)) {
            return self::NUMBER_6;
        } elseif (!in_array($coding[self::SEGMENT_E], $chars)) {
            return self::NUMBER_9;
        }
    }

    private function parseEight(array $eight, array $length_six, array $coding): array
    {
        foreach ($length_six as $number) {
            $wires = str_split($number);
            $diff = array_diff($eight, $wires);

            if (is_array($coding[self::SEGMENT_C]) && in_array(reset($diff), $coding[self::SEGMENT_C])) {
                $coding[self::SEGMENT_C] = reset($diff);
                $result = array_diff($coding[self::SEGMENT_F], $diff);
                $coding[self::SEGMENT_F] = reset($result);
            } elseif (is_array($coding[self::SEGMENT_D]) && in_array(reset($diff), $coding[self::SEGMENT_D])) {
                $coding[self::SEGMENT_D] = reset($diff);
                $result = array_diff($coding[self::SEGMENT_B], $diff);
                $coding[self::SEGMENT_B] = reset($result);
            } elseif (is_array($coding[self::SEGMENT_E]) && in_array(reset($diff), $coding[self::SEGMENT_E])) {
                $coding[self::SEGMENT_E] = reset($diff);
                $result = array_diff($coding[self::SEGMENT_G], $diff);
                $coding[self::SEGMENT_G] = reset($result);
            }
        }

        return $coding;
    }

    private function parseFour(array $four, array $coding): array
    {
        $diff = array_diff($four, $coding[self::SEGMENT_C]);

        $coding[self::SEGMENT_B] = $diff;
        $coding[self::SEGMENT_D] = $diff;

        $rest = array_diff($this->segments, array_merge([$coding[self::SEGMENT_A]], $coding[self::SEGMENT_C], $diff));

        $coding[self::SEGMENT_E] = $rest;
        $coding[self::SEGMENT_G] = $rest;

        return $coding;
    }

    private function parseOneAndSeven(array $one, array $seven): array
    {
        $diff = array_diff($seven, $one);

        return [
            self::SEGMENT_A => reset($diff),
            self::SEGMENT_C => $one,
            self::SEGMENT_F => $one,

        ];
    }

    private function getLengths(array $numbers): array
    {
        $lengths = [];

        foreach ($numbers as $number) {
            $lengths[strlen($number)][] = $number;
        }

        return $lengths;
    }
}
