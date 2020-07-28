<?php

namespace App\Input\Admin;
use Illuminate\Support\Facades\DB;
use App\Custom\Common;

class FutureMatches {
    public static $inputRegEx = [
        'team' => '/(\d+)$/i',
        'league' => '/(\d+)$/i',
        'date' => '/^(20([0-2][0-9]|3[0-7]))-(0[1-9]|1[1-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/',
        'time' => '/^([0-1][0-9]|[2][0-3]):([0-5][0-9])$/',
    ];

    public static function getMatchesFuture($columns = [], $whereSQL = false, $order = false, $limitValue = false)
    {
        $select = '*';
        $orderby = '';
        $where = 1;
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
            '.$select.' 
        FROM
            z11_dota2_matches_future 
        WHERE '.$where.$orderby.$limit);
        return $res;
    }

    public static function getTeam($input)
    {
        preg_match(self::$inputRegEx['team'], $input, $matches);
        return $matches[1];
    }

    public static function getLeague($input)
    {
        preg_match(self::$inputRegEx['league'], $input, $matches);
        return $matches[1];
    }

    public static function compareFutureMatchInputs($MFID, $fields)
    {
        $select = 'MFID';

        $where = 'MFID = '.$MFID;

        if (!isset($fields) || !is_array($fields) || empty($fields))
            return false;
        $where .= ' AND (';
        $first = 1;
        foreach ($fields as $key => $value)
        {
            if (!$first)
            {
                $where .= ' OR ';
            }
            $where .= '`'.$key.'` <> '.$value;
            $first = false;
        }
        $where .= ')';

        $sql = 'SELECT 
        '.$select.' 
        FROM
            z11_dota2_matches_future 
        WHERE '.$where;

        $res = DB::connection('z11_dota2_main')->select($sql);
        return !empty($res);
    }

    public static function updateFutureMatch($MFID, $fields)
    {
        $fields['timestamp'] = strtotime('now');
        if (isset($fields['team_0']) && $fields['team_0'])
        {
            $fields['team_0_name'] = DB::raw('(SELECT 
            `team_name` 
          FROM
            `z11_dota2_history`.`z11_dota2_teams` 
          WHERE `team_id` = '.$fields['team_0'].' 
          LIMIT 1)');
        }
        if (isset($fields['team_1']) && $fields['team_1'])
        {
            $fields['team_1_name'] = DB::raw('(SELECT 
            `team_name` 
          FROM
            `z11_dota2_history`.`z11_dota2_teams` 
          WHERE `team_id` = '.$fields['team_1'].' 
          LIMIT 1)');
        }
        $res = DB::connection('z11_dota2_main')->table('z11_dota2_matches_future')->where('MFID', $MFID)->update($fields);
        return ($res);
    }

    public static function delMatchFuture($MFID)
    {
        $res = DB::connection('z11_dota2_main')->table('z11_dota2_matches_future')->where('MFID', '=', $MFID)->delete();
        return $res;
    }

    public static function addMatchFuture($fields)
    {
        if (isset($fields['team_0']) && $fields['team_0'])
        {
            $fields['team_0_name'] = DB::raw('(SELECT 
                `team_name` 
            FROM
                `z11_dota2_history`.`z11_dota2_teams` 
            WHERE `team_id` = '.$fields['team_0'].' 
            LIMIT 1)');
        }
        if (isset($fields['team_1']) && $fields['team_1'])
        {
            $fields['team_1_name'] = DB::raw('(SELECT 
                `team_name` 
            FROM
                `z11_dota2_history`.`z11_dota2_teams` 
            WHERE `team_id` = '.$fields['team_1'].' 
            LIMIT 1)');
        }
        
        $res = DB::connection('z11_dota2_main')->table('z11_dota2_matches_future')->insert(
            $fields
        );

        return $res;
    }
    
}