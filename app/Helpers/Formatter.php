<?php

namespace App\Helpers;

class Formatter
{
    /**
     * Format number to short scale (K, M, B)
     * 
     * @param float|int $n
     * @return string
     */
    public static function currency($n)
    {
        if ($n < 1000) {
            return $n;
        }

        if ($n >= 1000000000) {
            return round($n / 1000000000, 1) . 'B';
        }

        if ($n >= 1000000) {
            return round($n / 1000000, 1) . 'M';
        }

        if ($n >= 1000) {
            return round($n / 1000, 1) . 'K'; // Uppercase K for professional look
        }

        return $n;
    }
}
