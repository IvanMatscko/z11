<?php
        

        
namespace App\Input\Admin;
use Illuminate\Support\Facades\Validator;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\DB;
use incl\steamapi\classes\SteamAPIModule;

class Teams {
    
    public static function getTeams($columns = [], $whereSQL = false, $order = false, $limitValue = false)
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
            `z11_dota2_teams` 
        WHERE '.$where.$orderby.$limit);
        return $res;
    }

    public static function compareTeamInputs($team_id, $fields)
    {
        $select = 'team_id';

        $where = 'team_id = '.$team_id;

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
            z11_dota2_teams 
        WHERE '.$where;

        $res = DB::connection('z11_dota2_history')->select($sql);
        return !empty($res);
    }

    public static function updateTeam($team_id, $fields)
    {
        $res = DB::connection('z11_dota2_history')->table('z11_dota2_teams')->where('team_id', $team_id)->update($fields);
        return ($res);
    }

    public static function addTeam($fields)
    {
        require env('BASE_DIR').'/steamAPIForLaravelInit.php';

        $steamAPIDota2 = SteamAPIModule::getInstance('dota2');

        $res = $steamAPIDota2->addAndUpdateTeam($fields['team_id']);

        return $res;
    }


    // public static function getTeamsPlayers($columns = [], $teamsIds = false, $order = false, $limitValue = false)
    // {
    //     // $select = '*';
    //     $orderby = '';
    //     $limit = '';
    //     // if (!empty($columns))
    //     //     $select = implode(',', $columns);
    //     if ($order)
    //         $orderby = ' ORDER BY '.$order.' ASC';
    //     if ($limitValue)
    //         $limit = ' LIMIT '.$limitValue;
    //     if (empty($teamsIds) || !is_array($teamsIds))
    //         return false;
    //     $teamsSqlPart = implode(',',$teamsIds);
    //     $res = DB::connection('z11_dota2_history')->select('SELECT 
    //         `d2p`.`account_id`,
    //         `d2p`.`name`,
    //         `d2t`.`team_id`
    //     FROM
    //         `z11_dota2_players` `d2p`,
    //         `z11_dota2_teams` `d2t` 
    //     WHERE 
    //         (`d2t`.`team_id` IN ('.$teamsSqlPart.')) AND
    //         (`d2p`.`account_id` = `d2t`.`player_0_account_id` OR
    //         `d2p`.`account_id` = `d2t`.`player_1_account_id` OR
    //         `d2p`.`account_id` = `d2t`.`player_2_account_id` OR
    //         `d2p`.`account_id` = `d2t`.`player_3_account_id` OR
    //         `d2p`.`account_id` = `d2t`.`player_4_account_id` OR
    //         `d2p`.`account_id` = `d2t`.`player_5_account_id`)'.$orderby.$limit);
    //     return $res;
    // }
}