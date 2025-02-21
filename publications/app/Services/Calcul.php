<?php 

namespace App\Services;

class Calcul
{
    public function add($a, $b)
    {
        return $a + $b;
    }

    public function sub($a, $b)
    {
        return $a - $b;
    }

    public function mul($a, $b)
    {
        return $a * $b;
    }

    public function div($a, $b)
    {
        return $a / $b;
    }
}