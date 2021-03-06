<?php

namespace Shadowinek\Aoc2021;

class Puzzle04Part02 extends Puzzle04Part01
{
    public function run(): int
    {
        $numbers = explode(',', array_shift($this->data));
        $this->data = array_filter($this->data);
        $inputs = [];
        $boards = [];
        $board_bingos = [];

        $row = 0;
        $bingo = 0;
        foreach ($this->data as $line) {
            $line_numbers = array_filter(explode(' ', trim(str_replace('  ', ' ', $line))), 'self::filter');

            $column = 0;
            foreach($line_numbers as $number) {
                $inputs['b' . $bingo . 'r' . $row]['c' . $column] = (int) $number;
                $inputs['b' . $bingo . 'c' . $column][$row] = (int) $number;
                $boards[$bingo][(int) $number] = (int) $number;
                $column++;
            }

            $row++;
            if ($row%5 === 0) {
                $bingo++;
            }
        }

        $results = [];

        foreach ($inputs as $i => $input) {
            $numbers_to_check = $numbers;
            $pos = 0;
            while (count($input) > 0 && count($numbers_to_check) > 0) {
                $last_number = (int) array_shift($numbers_to_check);

                $key = array_search($last_number, $input);
                unset($input[$key]);
                $pos++;
            }

            $results[$i] = [
                'last_number' => $last_number,
                'position' => $pos,
                'id' => $i,
            ];

            $board_bingos[$this->getBoardNumber($i)][] = $i;
        }

        while (count($board_bingos) > 1) {
            $to_search = array_column($results, 'position', 'id');
            $min_key = array_search(min($to_search), $to_search);
            $board_to_wipe = $this->getBoardNumber($min_key);

            foreach ($board_bingos[$board_to_wipe] as $bingo_id) {
                unset($results[$bingo_id]);
            }

            unset($board_bingos[$board_to_wipe]);
        }

        $to_search = array_column($results, 'position', 'id');
        $min_key = array_search(min($to_search), $to_search);
        $board = $boards[$this->getBoardNumber($min_key)];

        for ($x=0;$x<$results[$min_key]['position'];$x++) {
            unset($board[$numbers[$x]]);
        }

        return array_sum($board) * $results[$min_key]['last_number'];
    }
}
