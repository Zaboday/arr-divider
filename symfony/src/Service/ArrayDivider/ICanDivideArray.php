<?php
declare(strict_types=1);

namespace App\Service\ArrayDivider;

/**
 * Interface ICanDivideArray
 * Type of Service.
 */
interface ICanDivideArray
{
    /**
     * @param int $needle
     * @param array $haystack
     *
     * @return mixed
     */
    public function divide(int $needle, array $haystack): int;
}