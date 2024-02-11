<?php

if (!function_exists('convertCamelcaseToString')) {
    function convertCamelcaseToString($string)
    {
        return preg_replace('/([a-z])([A-Z])/', "$1 $2", $string);
    }
}
