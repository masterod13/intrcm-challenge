<?php


namespace Helper;


class Debug
{
    public static function printToScreen($var)
    {
        echo '<pre>'; echo print_r($var,true); echo '</pre>';
    }
}
