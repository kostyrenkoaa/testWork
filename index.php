#!/usr/bin/php
<?php

echo (new DefinitionOfProgression($argv))->getResult();

class DefinitionOfProgression
{
    /**
     * @var array Массив переданных скрипту аргументов
     */
    private $argv;

    /**
     * DefinitionOfProgression constructor.
     * @param array $argv Массив переданных скрипту аргументов
     */
    public function __construct($argv)
    {
        $this->argv = $argv;
    }

    /**
     * Возвращает результат о принадлежности строки к последовательности.
     *
     * @return string
     */
    public function getResult()
    {
        if (empty($this->argv[1])) {
            return 'Введена пустая строка';
        }

        $numbers = $this->getNumbers();
        if (empty($numbers)) {
            return 'Количество числ должно быть не менее двух.';
        }

        if ($this->isArithmeticProgression($numbers)) {
            return 'Введина арифметическая прогрессия';
        }

        if ($this->isGeometricProgression($numbers)) {
            return 'Введина геометрическая прогрессия';
        }

        return 'Введеная строка не является ни арифметическая ни геометрической  прогрессией';
    }

    /**
     * Обрабатывает введенные данные и возвращает числа в виде массива.
     *
     * @return array
     */
    private function getNumbers()
    {
        $str = '';
        foreach ($this->argv as $key => $params) {
            if ($key == 0) {
                continue;
            }
            $str .= trim($params);
        }

        $data = explode(',', $str);
        if (empty($data) || count($data) < 2) {
            return [];
        }
        $numbers = array_map(
            function ($number) {
                return trim($number);
            },
            $data);

        return $numbers;
    }

    /**
     * Проверяет является ли последовательность арифметической прогрессией.
     *
     * @param $numbers
     * @return bool
     */
    private function isArithmeticProgression($numbers)
    {
        $sequenceConstant = $numbers[1] - $numbers[0];
        $nextNumber = 0;
        foreach ($numbers as $key => $number) {
            if ($number != $nextNumber && $key != 0) {
                return false;
            }
            $nextNumber = $number + $sequenceConstant;
        }
        return true;
    }

    /**
     * Проверяет является ли последовательность геометрической прогрессией.
     *
     * @param $numbers
     * @return bool
     */
    private function isGeometricProgression($numbers)
    {
        $sequenceConstant = $numbers[1] / $numbers[0];
        $nextNumber = 0;
        foreach ($numbers as $key => $number) {
            if ($number != $nextNumber && $key != 0) {
                return false;
            }
            $nextNumber = $number * $sequenceConstant;
        }
        return true;
    }
}
