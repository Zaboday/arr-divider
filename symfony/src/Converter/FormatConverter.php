<?php

namespace App\Converter;

class FormatConverter
{
    /**
     * @param string|null $strHaystack
     * @param string $delimiter
     *
     * @return array
     */
    public static function stringHaystackToArray(string $strHaystack = null, $delimiter = ','): array
    {
        if (is_string($strHaystack)) {
            $strHaystack = trim($strHaystack);
        }
        if ($strHaystack === null || $strHaystack === '') {
            return [];
        }
        $arr = explode($delimiter, $strHaystack);
        $arr = array_map('intval', array_map('trim', $arr));

        return $arr;
    }
}