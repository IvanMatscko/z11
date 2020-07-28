<?php

namespace App\Input\Admin;
use Illuminate\Support\Facades\DB;
use incl\steamapi\classes\SteamAPIModule;

class LiveMatches {

    const SQLgetMatchesLiveNumberInSeries = '(SELECT 
        COUNT(`d2mp`.`match_id`) + 1 
    FROM
        `z11_dota2_matches_past` `d2mp`
    WHERE 
        `d2mp`.`winner` IS NOT NULL 
        AND `d2mp`.`series_id` = `m`.`series_id`) AS `number_in_series`';

    const SQLgetMatchesLiveRadiantWinInSeries = '(SELECT 
            COUNT(`match_id`) 
            FROM
            `z11_dota2_matches_past` `d2mp`
            WHERE 
            `d2mp`.`series_id` = `m`.`series_id`
            AND (
                (
                `team_0` = `m`.`team_id_radiant` 
                AND `winner` = 1
                ) 
                OR (
                `team_0` = `m`.`team_id_dire` 
                AND `winner` = 0
                )
            )) AS `radiant_win_in_series`';

    const SQLgetMatchesLiveDireWinInSeries = '(SELECT 
                COUNT(`match_id`) 
            FROM
                `z11_dota2_matches_past` `d2mp`
            WHERE 
                `d2mp`.`series_id` = `m`.`series_id`
                AND (
                (
                    `team_0` = `m`.`team_id_radiant` 
                    AND `winner` = 0
                ) 
                OR (
                    `team_0` = `m`.`team_id_dire` 
                    AND `winner` = 1
                )
                )) AS `dire_win_in_series` ';

    public static function getMatchesLive($columns = [], $whereSQL = false, $order = false, $limitValue = false, $useMrp=true)
    {
        $select = '`m`.*';
        $orderby = '';
        $where = '`m`.`match_id` = `mrp`.`match_id`';
        $limit = '';
        if (!empty($columns))
            $select = implode(',', $columns);
        if ($order)
            $orderby = ' ORDER BY '.$order.' ASC';
        if ($whereSQL)
            $where = $whereSQL;
        if ($limitValue)
            $limit = ' LIMIT '.$limitValue;

        $res = DB::connection('z11_dota2_main')->select('SELECT 
            '.$select.',
            IF(`m`.`map_start`>0, (SELECT (UNIX_TIMESTAMP() - `map_start`) DIV 60 FROM `z11_dota2_matches` WHERE `match_id` = `m`.`match_id`), 0) AS `minutes`,
            IF(`m`.`map_start`>0, (SELECT (UNIX_TIMESTAMP() - `map_start`) % 60 FROM `z11_dota2_matches` WHERE `match_id` = `m`.`match_id`), 0) AS `seconds`
        FROM
            '.($useMrp?'z11_dota2_matches_realtimestats_players `mrp`,':'').'
            z11_dota2_matches `m`
        WHERE 
        '.$where.$orderby.$limit);
        return $res;
    }

    // public static function buildingTest()
    // {
    //     $res = DB::connection('z11_dota2_main')->select('SELECT 
    //         *
    //     FROM
    //         z11_dota2_matches `m`
    //     WHERE 
    //     1');

    //     if (!empty($res))
    //     {
    //         foreach ($res as $key => $value)
    //         {
    //             $binState = decbin($value->building_state);
    //             $state[$value->match_id] = substr($binState,9,7);
    //         }
    //     }

    //     return $state;
    // }

    public static function prepareBuildingStateData($buildingState)
    {
        $matches = [
            '001' => [0,0,0,0,0],
            '010' => [1,0,0,0,0],
            '011' => [1,1,0,0,0],
            '100' => [1,1,1,0,0],
            '101' => [1,1,1,1,0],
            '110' => [1,1,1,0,1],
            '111' => [1,1,1,1,1],
        ];
        if (empty($buildingState))
            return false;
        $binState = decbin($buildingState);
        while (strlen($binState) < 25)
        {
            $binState = '0'.$binState;
        }
        $state['R']['top'] = isset($matches[substr($binState,22,3)])? $matches[substr($binState,22,3)] : false;
        $state['R']['mid'] = isset($matches[substr($binState,19,3)])? $matches[substr($binState,19,3)] : false;
        $state['R']['bot'] = isset($matches[substr($binState,16,3)])? $matches[substr($binState,16,3)] : false;
        $state['D']['top'] = isset($matches[substr($binState,6,3)])? $matches[substr($binState,6,3)] : false;
        $state['D']['mid'] = isset($matches[substr($binState,3,3)])? $matches[substr($binState,3,3)] : false;
        $state['D']['bot'] = isset($matches[substr($binState,0,3)])? $matches[substr($binState,0,3)] : false;
        return $state;
    }


    public static function updateLiveMatch($match_id, $fields)
    {
        $res = DB::connection('z11_dota2_main')->table('z11_dota2_matches')->where('match_id', $match_id)->update($fields);
        return ($res);
    }

    public static function closeLiveMatch($match_id)
    {
        require env('BASE_DIR').'/steamAPIForLaravelInit.php';
        $res = DB::connection('z11_dota2_main')->table('z11_dota2_matches')->where('match_id', $match_id)->update(['MStatus'=>env('MSTATUS_LIVE_GET_STATS_TIME_START_L')]);
    
        $steamAPIDota2 = SteamAPIModule::getInstance('dota2');
        $steamAPIDota2->moveToPast([$match_id]);

        $res = DB::connection('z11_dota2_main')->table('z11_dota2_matches')->where('match_id', $match_id)->update(['MStatus'=>env('MSTATUS_LIVE_L')]);
        $res = DB::connection('z11_dota2_main')->table('z11_dota2_matches_realtimestats_players')->where('match_id', '=', $match_id)->delete();

        return ($res);
    }

    public static function deleteLiveMatch($match_id)
    {
        $res = DB::connection('z11_dota2_main')->table('z11_dota2_matches')->where('match_id', $match_id)->update(['MStatus'=>env('MSTATUS_LIVE_L')]);
        $res = DB::connection('z11_dota2_main')->table('z11_dota2_matches_realtimestats_players')->where('match_id', '=', $match_id)->delete();
        return ($res);
    }
}