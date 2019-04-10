<?php
declare(strict_types=1);

namespace App\Service\ArrayDivider;

/**
 * Class ArrayDividerService
 */
class ArrayDividerService implements ICanDivideArray
{
    public const ERROR_CODE = -1;

    /**
     * Дано: Необходимо разделить входной массив таким образом, чтобы количество чисел N в первой части оказалось равно
     * количеству чисел не равных N во второй и это количество должно быть больше 0. Если невозможно возвращаем -1.
     * Сложность алгоритма должна быть o(n) по времени и о(1) по памяти
     *
     * Решение:
     * Проверяем условия для крайних (левого и правого) элементов массива в цикле.
     * Для левой части массива элемент должен быть равен $needle,
     * для правой должен быть НЕ равен $needle. Если в какой-то части условие не выполнилось - берем следующий
     * элемент из этой же части пока счетчик в левой части не станет равен счетчику в правой части.
     * Цикл прерывается когда пройдены все элементы массива по разу.
     *
     * @param int $needle
     * @param array $haystack
     *
     * @return int|mixed
     */
    public function divide(int $needle, array $haystack): int
    {
        $leftCounter = $rightCounter = $leftCurrentIndex = $rightCurrentIndex = 0;
        $haystackSize = count($haystack);
        $stepLeftToRight = $stepRightToLeft = true;
        for ($i = 0; $i < $haystackSize; $i++) {
            if ($leftCurrentIndex + $rightCurrentIndex >= $haystackSize) {
                break;
            }
            if ($stepLeftToRight && $haystack[$leftCurrentIndex] === $needle) {
                $leftCounter++;
            }
            if ($stepRightToLeft && $haystack[$haystackSize - $rightCurrentIndex - 1] !== $needle) {
                $rightCounter++;
            }
            if ($leftCounter > $rightCounter) {
                $rightCurrentIndex++;
                $stepLeftToRight = false;
                $stepRightToLeft = true;
                continue;
            }

            if ($leftCounter < $rightCounter) {
                $leftCurrentIndex++;
                $stepLeftToRight = true;
                $stepRightToLeft = false;
                continue;
            }
            $stepLeftToRight = $stepRightToLeft = true;
            $leftCurrentIndex++;
            $rightCurrentIndex++;
        }

        return $leftCounter && $rightCounter ? $leftCurrentIndex : self::ERROR_CODE;
    }
}