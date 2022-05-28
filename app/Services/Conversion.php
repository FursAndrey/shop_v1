<?php
namespace App\Services;

use App\Models\Currency;

class Conversion
{
    protected static $container;

    public static function getCurrencies()
    {
        self::loadContainer();
        return self::$container;
    }

    public static function convert($sum, $from = 'BYN', $to = null)
    {
        self::loadContainer();
        $originCurrency = self::$container[$from];
        if (is_null($to)) {
            $to = session('currency', 'BYN');
        }
        $targetCurrency = self::$container[$to];

        return round($sum * $originCurrency->rate / $targetCurrency->rate, 2);
    }

    public static function getCurCode()
    {
        // self::loadContainer();
        return session('currency', 'BYN');
    }
    
    protected static function loadContainer()
    {
        if (is_null(self::$container)) {
            $currencies = Currency::get();
            foreach ($currencies as $cur) {
                self::$container[$cur->code] = $cur;
            }
        }
    }

}
