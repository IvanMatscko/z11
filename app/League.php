<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\League
 *
 * @property int $LID
 * @property int|null $league_id
 * @property string|null $tournament_url
 * @property string|null $name_EN
 * @property int|null $start_time
 * @property int|null $end_time
 * @property bool|null $LStatus
 * @method static \Illuminate\Database\Eloquent\Builder|\App\League whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\League whereLID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\League whereLStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\League whereLeagueId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\League whereNameEN($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\League whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\League whereTournamentUrl($value)
 * @mixin \Eloquent
 */
class League extends Model
{
    /**
     * @var string
     */
    protected $table = 'z11_dota2_leagues';

    /**
     * @var string
     */
    protected $primaryKey = 'LID';

    /**
     * The connection name for the model.
     *
     * @var string|null
     */
    protected $connection = "z11_dota2_history";

    /**
     * @return string
     */
    public static function getLeaguesTeamsDataSql()
    {
        return "SELECT l.*, t.team_id
                FROM 
                    `z11_dota2_history`.`z11_dota2_leagues` AS l,
                    `z11_dota2_history`.`z11_dota2_leagues_2_teams` AS t
                WHERE 
                    `l`.`LID` = `t`.`LID` AND l.`LID` = ?";
    }

    /**
     * @return string
     */
    public static function getLeagueTeams()
    {
        return "SELECT t.*
                FROM 
                    `z11_dota2_history`.`z11_dota2_teams` AS t,
                    `z11_dota2_history`.`z11_dota2_leagues_2_teams` AS lt
                WHERE 
                   t.`team_id` IN (SELECT `team_id` FROM `z11_dota2_history`.`z11_dota2_leagues_2_teams` WHERE LID = ?)";
    }
}
