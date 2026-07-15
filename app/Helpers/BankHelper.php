<?php

namespace App\Helpers;

class BankHelper
{
    public static function mask(string $number): string
    {
        $len = strlen($number);
        if ($len <= 4) {
            return $number;
        }
        return substr($number, 0, 4) . str_repeat('x', max(0, $len - 8)) . substr($number, -4);
    }
}
