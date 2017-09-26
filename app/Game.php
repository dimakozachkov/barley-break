<?php

namespace App;

class Game
{

    /**
     * Checks if the game is over
     *
     * @param $data
     * @return bool
     */
    private function checkData($data)
    {
        $answer = false;
        $arr = [];

        /* Merge all array */
        foreach ($data as $item) {
            array_merge($arr, $item);
        }

        /* Check all cell */
        for ($i = 0; $i < count($arr); $i++) {
            if ($i == 15 && is_string($arr[$i])) {
                $answer = true;
                break;
            }

            if ($arr[$i] + 1 == $arr[$i+1]) {
                continue;
            } else {
                break;
            }
        }

        return $answer;

    }

    /**
     * Initializes the game data
     *
     * @return array
     */
    public function start()
    {

        // Init data for cells
        $items = [
            1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, ' '
        ];

        // Create the game field
        $fields = [
            ['', '', '', ''],
            ['', '', '', ''],
            ['', '', '', ''],
            ['', '', '', ''],
        ];

        // Mix all data for cells
        shuffle($items);

        // Push all data to the game field
        for ($i = 0; $i < count($fields); $i++) {
            for ($k = 0; $k < count($fields[$i]); $k++) {
                $fields[$i][$k] = array_shift($items);
            }
        }

        return $fields;

    }

    /**
     * Calculates the gameplay
     *
     * @param $fields
     * @param $row
     * @param $column
     * @return string
     */
    public function calculate($fields, $row, $column)
    {

        // Calculate a shift
        if (isset($fields[$row+1][$column]) && is_string($fields[$row+1][$column])) {
            $fields[$row+1][$column] = $fields[$row][$column];
            $fields[$row][$column] = ' ';
        } elseif (isset($fields[$row][$column+1]) && is_string($fields[$row][$column+1])) {
            $fields[$row][$column+1] = $fields[$row][$column];
            $fields[$row][$column] = ' ';
        } elseif (isset($fields[$row-1][$column]) && is_string($fields[$row-1][$column])) {
            $fields[$row-1][$column] = $fields[$row][$column];
            $fields[$row][$column] = ' ';
        } elseif (isset($fields[$row][$column-1]) && is_string($fields[$row][$column-1])) {
            $fields[$row][$column-1] = $fields[$row][$column];
            $fields[$row][$column] = ' ';
        }

        // If the game is over return finish message
        if ($this->checkData($fields)) {
            return 'finish';
        }

        return $fields;

    }
}
