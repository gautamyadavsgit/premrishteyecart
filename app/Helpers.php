<?php

if (!function_exists('getEnumValues')) {

if (!function_exists('getEnumValues')) {
    function getEnumValues($tableName, $enumColumnName)
    {
        // Retrieve the possible values of the ENUM column
        $enumValues = \Illuminate\Support\Facades\DB::select(
            \Illuminate\Support\Facades\DB::raw("SHOW COLUMNS FROM $tableName WHERE Field = '$enumColumnName'")
        )[0]->Type;

        // Extract the ENUM values from the column definition
        preg_match('/^enum\((.*)\)$/', $enumValues, $matches);

        // Split the comma-separated values into an array
        $enumArray = explode(',', $matches[1]);

        // Trim quotes and spaces from each value
        $enumValues = array_map(function ($value) {
            return trim($value, "' ");
        }, $enumArray);

        return $enumValues;
    }
}