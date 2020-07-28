<?php

namespace App\Input\Admin;
use Illuminate\Support\Facades\DB;

class MergeSeries {
    
    public static function mergeSeries($series_id, $second_series_id)
    {
        $timestamps = DB::connection('z11_dota2_main')->select('SELECT 
            MAX(`first`.`time`) AS `first_time`, 
            MAX(`second`.`time`) AS `second_time`
        FROM 
            (SELECT `activate_time` AS `time` FROM `z11_dota2_matches` WHERE `series_id` = '.$series_id.' UNION ALL SELECT `timestamp` AS `time` FROM `z11_dota2_matches_past` WHERE `series_id` = '.$series_id.') `first`,
            (SELECT `activate_time` AS `time` FROM `z11_dota2_matches` WHERE `series_id` = '.$second_series_id.' UNION ALL SELECT `timestamp` AS `time` FROM `z11_dota2_matches_past` WHERE `series_id` = '.$second_series_id.') `second`
        WHERE 1');

        if (empty($timestamps))
            abort(404);
        $source_series_id = ($timestamps[0]->first_time > $timestamps[0]->second_time) ? $series_id : $second_series_id;
        $target_series_id = ($timestamps[0]->first_time > $timestamps[0]->second_time) ? $second_series_id : $series_id;

        //merge series
        $res = DB::connection('z11_dota2_main')->table('z11_dota2_matches')->where('series_id', $target_series_id)->update(['series_id'=>$source_series_id]);
        $res = DB::connection('z11_dota2_main')->table('z11_dota2_matches_past')->where('series_id', $target_series_id)->update(['series_id'=>$source_series_id]);

        //recalculate results
        $mergedPastMatches = DB::connection('z11_dota2_main')->select('SELECT `match_id` FROM `z11_dota2_matches_past` WHERE `series_id` = '.$source_series_id);

        foreach ($mergedPastMatches as $match)
        {
            $fields = [];
            $fields['number_in_series'] = DB::raw('(SELECT 
                COUNT(`d2mp`.`match_id`) 
            FROM
                (SELECT 
                * 
                FROM
                `z11_dota2_matches_past`) `d2mp` 
            WHERE `d2mp`.`series_id` = '.$source_series_id.' 
                AND `d2mp`.`winner` IS NOT NULL 
                AND `d2mp`.`timestamp` <= 
                (SELECT 
                `timestamp` 
                FROM
                (SELECT 
                    `match_id`,
                    `timestamp` 
                FROM
                    `z11_dota2_matches_past`) `d2mp2` 
                WHERE `match_id` = '.$match->match_id.' 
                LIMIT 1))');
            $fields['radiant_win_in_series'] = DB::raw('(SELECT 
                COUNT(`d2mp`.`match_id`) 
            FROM
                (SELECT 
                * 
                FROM
                `z11_dota2_matches_past`) `d2mp` 
            WHERE `d2mp`.`series_id` = '.$source_series_id.'
                AND (
                (
                    `d2mp`.`team_0` = 
                    (SELECT 
                    `team_0` 
                    FROM
                    (SELECT 
                        `match_id`,
                        `team_0` 
                    FROM
                        `z11_dota2_matches_past`) `d2mp2` 
                    WHERE `match_id` = '.$match->match_id.'
                    LIMIT 1) 
                    AND `d2mp`.`winner` = 1
                ) 
                OR (
                    `d2mp`.`team_0` = 
                    (SELECT 
                    `team_1` 
                    FROM
                    (SELECT 
                        `match_id`,
                        `team_1` 
                    FROM
                        `z11_dota2_matches_past`) `d2mp2` 
                    WHERE `match_id` = '.$match->match_id.'
                    LIMIT 1) 
                    AND `d2mp`.`winner` = 0
                )
                ) 
                AND `d2mp`.`timestamp` <= 
                (SELECT 
                `timestamp` 
                FROM
                (SELECT 
                    `match_id`,
                    `timestamp` 
                FROM
                    `z11_dota2_matches_past`) `d2mp2` 
                WHERE `match_id` = '.$match->match_id.'
                LIMIT 1))');
            $fields['dire_win_in_series'] = DB::raw('(SELECT 
                COUNT(`d2mp`.`match_id`) 
            FROM
                (SELECT 
                * 
                FROM
                `z11_dota2_matches_past`) `d2mp` 
            WHERE `d2mp`.`series_id` = '.$source_series_id.' 
                AND (
                (
                    `d2mp`.`team_0` = 
                    (SELECT 
                    `team_0` 
                    FROM
                    (SELECT 
                        `match_id`,
                        `team_0` 
                    FROM
                        `z11_dota2_matches_past`) `d2mp2` 
                    WHERE `match_id` = '.$match->match_id.' 
                    LIMIT 1) 
                    AND `d2mp`.`winner` = 0
                ) 
                OR (
                    `d2mp`.`team_0` = 
                    (SELECT 
                    `team_1` 
                    FROM
                    (SELECT 
                        `match_id`,
                        `team_1` 
                    FROM
                        `z11_dota2_matches_past`) `d2mp2` 
                    WHERE `match_id` = '.$match->match_id.' 
                    LIMIT 1) 
                    AND `d2mp`.`winner` = 1
                )
                ) 
                AND `d2mp`.`timestamp` <= 
                (SELECT 
                `timestamp` 
                FROM
                (SELECT 
                    `match_id`,
                    `timestamp` 
                FROM
                    `z11_dota2_matches_past`) `d2mp2` 
                WHERE `match_id` = '.$match->match_id.' 
                LIMIT 1))');
            $res = DB::connection('z11_dota2_main')->table('z11_dota2_matches_past')->where('match_id', '=', $match->match_id)->update($fields);
        }

        //need to update in two steps. DON'T FUCKING OPTIMIZE THIS!!!!
        foreach ($mergedPastMatches as $match)
        {
            $fields = [];
            $fields['radiant_win_maps'] = DB::raw('(SELECT 
                GROUP_CONCAT(`number_in_series`) 
            FROM
                (SELECT 
                * 
                FROM
                `z11_dota2_matches_past`) `d2mp` 
            WHERE `d2mp`.`series_id` = '.$source_series_id.' 
                AND (
                (
                    `d2mp`.`team_0` = 
                    (SELECT 
                    `team_0` 
                    FROM
                    (SELECT 
                        `match_id`,
                        `team_0` 
                    FROM
                        `z11_dota2_matches_past`) `d2mp2` 
                    WHERE `match_id` = '.$match->match_id.' 
                    LIMIT 1) 
                    AND `d2mp`.`winner` = 1
                ) 
                OR (
                    `d2mp`.`team_0` = 
                    (SELECT 
                    `team_1` 
                    FROM
                    (SELECT 
                        `match_id`,
                        `team_1` 
                    FROM
                        `z11_dota2_matches_past`) `d2mp2` 
                    WHERE `match_id` = '.$match->match_id.' 
                    LIMIT 1) 
                    AND `d2mp`.`winner` = 0
                )
                ) 
                AND `d2mp`.`timestamp` <= 
                (SELECT 
                `timestamp` 
                FROM
                (SELECT 
                    `match_id`,
                    `timestamp` 
                FROM
                    `z11_dota2_matches_past`) `d2mp2` 
                WHERE `match_id` = '.$match->match_id.' 
                LIMIT 1))');
            $fields['dire_win_maps'] = DB::raw('(SELECT 
                GROUP_CONCAT(`number_in_series`) 
            FROM
                (SELECT 
                * 
                FROM
                `z11_dota2_matches_past`) `d2mp` 
            WHERE `d2mp`.`series_id` = '.$source_series_id.' 
                AND (
                (
                    `d2mp`.`team_0` = 
                    (SELECT 
                    `team_0` 
                    FROM
                    (SELECT 
                        `match_id`,
                        `team_0` 
                    FROM
                        `z11_dota2_matches_past`) `d2mp2` 
                    WHERE `match_id` = '.$match->match_id.' 
                    LIMIT 1) 
                    AND `d2mp`.`winner` = 0
                ) 
                OR (
                    `d2mp`.`team_0` = 
                    (SELECT 
                    `team_1` 
                    FROM
                    (SELECT 
                        `match_id`,
                        `team_1` 
                    FROM
                        `z11_dota2_matches_past`) `d2mp2` 
                    WHERE `match_id` = '.$match->match_id.' 
                    LIMIT 1) 
                    AND `d2mp`.`winner` = 1
                )
                ) 
                AND `d2mp`.`timestamp` <= 
                (SELECT 
                `timestamp` 
                FROM
                (SELECT 
                    `match_id`,
                    `timestamp` 
                FROM
                    `z11_dota2_matches_past`) `d2mp2` 
                WHERE `match_id` = '.$match->match_id.' 
                LIMIT 1))');
            $res = DB::connection('z11_dota2_main')->table('z11_dota2_matches_past')->where('match_id', '=', $match->match_id)->update($fields);
        }
        return $res;
    }
}