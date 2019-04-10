<?php

namespace App\Service\ArrayDivider;

/**
 * Interface ICanDivide
 * Type of Service.
 *
 */
interface ICanDivide
{
    /**
     * @param int $n
     * @param array $data
     *
     * @return mixed
     */
    public function divide(int $n, array $data);
}