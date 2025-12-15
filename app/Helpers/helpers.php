<?php


if (! function_exists('moneyFormat')) {    
    /**
     * moneyFormat
     *
     * @param  mixed $str
     * @return mixed
     */
    function moneyFormat($str) {
         return 'Rp. ' . number_format($str, 0, ',', '.');
    }
}
