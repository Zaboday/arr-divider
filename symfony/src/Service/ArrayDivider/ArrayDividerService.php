<?php

namespace App\Service\ArrayDivider;

/**
 * Class ArrayDividerService
 */
class ArrayDividerService implements ICanDivide
{
    public const ERROR_CODE = -1;

    public function divide(int $n, array $data)
    {
        return self::ERROR_CODE;
    }
}