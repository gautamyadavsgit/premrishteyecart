<?php

namespace App\Enums;

// use DB;
use Illuminate\Support\Facades\DB;

class PaymentMerchants
{
    public static function getEnumValues($table, $column)
    {
        $columns = DB::select("SHOW COLUMNS FROM $table  WHERE Field = ?", [$column]);
        $stringEnum = substr($columns[0]->Type, 6, -2); // strip "ENUM(" and ") from the result
        $enumArray = explode("','", $stringEnum);     // convert string to array
        // dd($enumArray);
        return $enumArray;
    }
}
