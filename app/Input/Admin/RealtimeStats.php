<?php

namespace App\Input\Admin;
use Illuminate\Support\Facades\DB;

class RealtimeStats {


    public static function getRealtimeStats($matchID)
    {
        $select = '*';
        // $orderby = '';
        $where = '`match_id` = '.$matchID;
        // $limit = '';
        // if (!empty($columns))
        //     $select = implode(',', $columns);
        // if ($order)
        //     $orderby = ' ORDER BY '.$order.' ASC';
        // if ($whereSQL)
        //     $where = $whereSQL;
        // if ($limitValue)
        //     $limit = ' LIMIT '.$limitValue;
        $res = DB::connection('z11_dota2_main')->select('SELECT 
            '.$select.' 
        FROM
            z11_dota2_matches_realtimestats_players 
        WHERE '.$where//.$orderby.$limit
        );
        return !empty($res) ? $res[0] : false;
    }
    
}