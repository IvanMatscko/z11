<?php

namespace App\Input\Admin;
use Illuminate\Support\Facades\DB;

class PastMatches {
    
    public static function getMatchesPast($columns = [], $whereSQL = false, $order = false, $limitValue = false, $numberInSeries=false)
    {
        $select = '`d2mp`.*';
        $orderby = '';
        $where = '1';
        $limit = '';
        if (!empty($columns))
            $select = implode(',', $columns);
        if ($order)
            $orderby = ' ORDER BY '.$order.' DESC';
        if ($whereSQL)
            $where = $whereSQL;
        if ($limitValue)
            $limit = ' LIMIT '.$limitValue;
        $groupBy = '';
        if ($numberInSeries)
        {
            $select .= ',
            (SELECT 
                MAX(`timestamp`) 
            FROM
                `z11_dota2_matches_past` 
            WHERE `series_id` = `d2mp`.`series_id`) AS `lm_timestamp`,
            (SELECT 
                `match_id` 
            FROM
                `z11_dota2_matches_past` 
            WHERE `series_id` = `d2mp`.`series_id` 
                AND `timestamp` = `lm_timestamp` LIMIT 1) AS `lm_id`,
            (SELECT 
                `team_0` 
            FROM
                `z11_dota2_matches_past` 
            WHERE `series_id` = `d2mp`.`series_id` 
                AND `timestamp` = `lm_timestamp` LIMIT 1) AS `lm_team_0`,
            (SELECT 
                `team_1` 
            FROM
                `z11_dota2_matches_past` 
            WHERE `series_id` = `d2mp`.`series_id` 
                AND `timestamp` = `lm_timestamp` LIMIT 1) AS `lm_team_1`,
            (SELECT 
                `team_0_name` 
            FROM
                `z11_dota2_matches_past` 
            WHERE `series_id` = `d2mp`.`series_id` 
            AND `timestamp` = `lm_timestamp` LIMIT 1) AS `lm_team_0_name`,
            (SELECT 
                `team_1_name` 
            FROM
                `z11_dota2_matches_past` 
            WHERE `series_id` = `d2mp`.`series_id` 
            AND `timestamp` = `lm_timestamp` LIMIT 1) AS `lm_team_1_name`,
            (SELECT 
                `winner` 
            FROM
                `z11_dota2_matches_past` 
            WHERE `series_id` = `d2mp`.`series_id` 
                AND `timestamp` = `lm_timestamp` LIMIT 1) AS `lm_winner`,
            (SELECT 
                `number_in_series` 
            FROM
                `z11_dota2_matches_past` 
            WHERE `series_id` = `d2mp`.`series_id` 
                AND `timestamp` = `lm_timestamp` LIMIT 1) AS `number_in_series`,
            (SELECT 
                `radiant_win_in_series` 
            FROM
                `z11_dota2_matches_past` 
            WHERE `series_id` = `d2mp`.`series_id` 
                AND `timestamp` = `lm_timestamp` LIMIT 1) AS `radiant_win_in_series`,
            (SELECT 
                `dire_win_in_series` 
            FROM
                `z11_dota2_matches_past` 
            WHERE `series_id` = `d2mp`.`series_id` 
                AND `timestamp` = `lm_timestamp` LIMIT 1) AS `dire_win_in_series`,
            (SELECT 
                `radiant_win_maps` 
            FROM
                `z11_dota2_matches_past` 
            WHERE `series_id` = `d2mp`.`series_id` 
                AND `timestamp` = `lm_timestamp` LIMIT 1) AS `radiant_win_maps`,
            (SELECT 
                `dire_win_maps` 
            FROM
                `z11_dota2_matches_past` 
            WHERE `series_id` = `d2mp`.`series_id` 
                AND `timestamp` = `lm_timestamp` LIMIT 1) AS `dire_win_maps`';
            $groupBy = ' GROUP BY `series_id`';
        }
        $sql = 'SELECT 
        '.$select.' 
      FROM
        `z11_dota2_matches_past` `d2mp`
      WHERE '.$where.$groupBy.$orderby.$limit;
        $res = DB::connection('z11_dota2_main')->select($sql);
        return $res;
    }

    public static function updatePastMatch($match_id, $fields)
    {
        $res = DB::connection('z11_dota2_main')->table('z11_dota2_matches_past')->where('match_id', $match_id)->update($fields);
        return ($res);
    }

    public static function deletePastMatch($match_id)
    {
        $res = DB::connection('z11_dota2_main')->table('z11_dota2_matches_past')->where('match_id', '=', $match_id)->delete();
        return ($res);
    }

    public static function recalculateSeriesResultsByPastMatch($match_id)
    {
        $pastMatchSeriesId = DB::connection('z11_dota2_main')->select('SELECT `series_id` FROM `z11_dota2_matches_past` WHERE `match_id` = '.$match_id);
        if (empty($pastMatchSeriesId))
            return false;
        $pastMatchSeriesId = $pastMatchSeriesId[0]->series_id;

        //recalculate results
        $mergedPastMatches = DB::connection('z11_dota2_main')->select('SELECT `match_id` FROM `z11_dota2_matches_past` WHERE `series_id` = '.$pastMatchSeriesId);

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
            WHERE `d2mp`.`series_id` = '.$pastMatchSeriesId.' 
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
            WHERE `d2mp`.`series_id` = '.$pastMatchSeriesId.'
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
            WHERE `d2mp`.`series_id` = '.$pastMatchSeriesId.' 
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
            WHERE `d2mp`.`series_id` = '.$pastMatchSeriesId.' 
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
            WHERE `d2mp`.`series_id` = '.$pastMatchSeriesId.' 
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
    }
}
