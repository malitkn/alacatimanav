<?php
namespace App\Traits;

trait DecimalHelper
{
    public function truncateDecimal($value, $decimals = 2) {
       $factor = pow(10, $decimals);
	   return floor($factor * $value) / $factor;
    }
}