<?php

namespace App\Input\Admin;
use Illuminate\Support\Facades\DB;

class Leagues {
    
    public const PAST = 0;
    public const FUTURE = 2;
    public const LIVE = 1;

    public static $BO = [
        0,1,2,3,5
    ];

    public static function statuses()
    {
        return [
            self::PAST => 'Past',
            self::FUTURE => 'Future',
            self::LIVE => 'Live'
        ];
    }

    /**
     * @param $status
     *
     * @return mixed
     */
    public static function getListStatus($status)
    {
        if (array_key_exists($status, self::statuses())) {
            return self::statuses()[$status];
        }

        return "--";
    }

    public static function getLeaguesTeams($columns = [], $whereSQL = false, $order = false, $limitValue = false)
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
            `z11_dota2_leagues_2_teams` 
        WHERE '.$where.$orderby.$limit);
        return $res;
    }


    public static function getLeagues($columns = [], $whereSQL = false, $order = false, $limitValue = false)
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
            `z11_dota2_leagues` 
        WHERE '.$where.$orderby.$limit);
        return $res;
    }

    public static function addLeague($fields)
    {
        $res = DB::connection('z11_dota2_history')->table('z11_dota2_leagues')->insertGetId(
            $fields
        );

        return $res;
    }

    /**
     * @param $leagues_to_teams
     *
     * @return bool
     */
    public static function addLeaguesToTeams($leagues_to_teams)
    {
        return DB::connection('z11_dota2_history')->table('z11_dota2_leagues_2_teams')->insert(
            $leagues_to_teams
        );
    }

    /**
     * @param array $fields
     * @param int $LID
     */
    public static function updateLeaguesToTeams(array $fields, int $LID)
    {
        DB::connection('z11_dota2_history')->table('z11_dota2_leagues_2_teams')->where('LID', $LID)->delete();
        DB::connection('z11_dota2_history')->table('z11_dota2_leagues_2_teams')->where('LID', $LID)->insert($fields);
    }

    public static function delLeague($LID)
    {
        $res = DB::connection('z11_dota2_history')->table('z11_dota2_leagues')->where('LID', '=', $LID)->delete();
        return $res;
    }

    public static function updateLeague($LID, $fields)
    {
        $res = DB::connection('z11_dota2_history')->table('z11_dota2_leagues')->where('LID', '=', $LID)->update($fields);
        return ($res);
    }
}