<?php

namespace App\Custom;
use Illuminate\Support\Facades\Request;
use App\Custom\Language;
use Illuminate\Support\Facades\DB;
use App\Input\Admin\Teams;


class Common {

    public static function parsePath($path)
    {
        return explode('/', $path);
    }

    public static function prepareLanguageBlock()
    {
        return Language::getURLwithLanguages(Request::path());
    }

    public static function prepareSearchBlock()
    {
        $search_block = [];
        $teams = Teams::getTeams([],'`display` = 1',false,false);
        foreach ($teams as $team)
        {
            $search_block[] = $team->team_name.' - Team';
        }
        return $search_block;
    }

    public static function searchInHistoryByName($name, $options = [])
    {
        $sqls = [];
        $sqls['teams'] = 'SELECT
            `team_id` AS `id`,
            (SELECT \'team\') AS `type`
        FROM
            `z11_dota2_teams`
        WHERE
            `team_name` = \''.$name.'\'';

        $sqls['players'] = 'SELECT
            `account_id` AS `id`,
            (SELECT \'player\') AS `type`
        FROM
            `z11_dota2_players`
        WHERE
            `name` = \''.$name.'\'';
        if (isset($options['teams_only']))
        {
            unset($sqls['players']);
        }
        if (isset($options['players_only']))
        {
            unset($sqls['teams']);
        }
        if (empty($sqls))
            return false;
        $sql = implode(' UNION ALL ', $sqls);

        $res = DB::connection('z11_dota2_history')->select($sql);

        return $res;
    }

}