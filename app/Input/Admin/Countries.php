<?php

namespace App\Input\Admin;
use Illuminate\Support\Facades\DB;

class Countries {
    
    public static function getCountries($columns = [], $whereSQL = false, $order = false, $limitValue = false)
    {
        $select = '*';
        $orderby = '';
        $where = '1';
        $limit = '';
        if (!empty($columns))
            $select = implode(',', $columns);
        if ($order)
            $orderby = ' ORDER BY '.$order.' ASC';
        if ($whereSQL)
            $where = $whereSQL;
        if ($limitValue)
            $limit = ' LIMIT '.$limitValue;
        $res = DB::connection('z11_dota2_history')->select('SELECT 
        '.$select.' 
        FROM
            `z11_dota2_countries` 
        WHERE '.$where.$orderby.$limit);
        return $res;
    }
}