<?php

namespace App\Helper;

class MenuHelper
{
    public static function beatifulyComposition(array $composition) : string
    {
        $compos = '';
        foreach ($composition as $key=>$value)
        {
            $compos .= $value;
            $compos .= ' ';
        }

        return $compos;
    }
}
