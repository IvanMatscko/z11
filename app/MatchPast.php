<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\MatchPast
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchPast newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchPast newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchPast query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchPast whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchPast whereAge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchPast whereCash($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchPast whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchPast wherePosition($value)
 * @mixin \Eloquent
 * @property int $match_id
 * @property int|null $team_0
 * @property int|null $team_1
 * @property string|null $team_0_name
 * @property string|null $team_1_name
 * @property int|null $team_0_score
 * @property int|null $team_1_score
 * @property int|null $league_id
 * @property int|null $series_id
 * @property int|null $timestamp
 * @property bool|null $winner
 * @property bool|null $MAttempts
 * @property int|null $9_accountid
 * @property int|null $9_heroid
 * @property int|null $9_kill_count
 * @property int|null $9_death_count
 * @property int|null $9_assists_count
 * @property int|null $8_accountid
 * @property int|null $8_heroid
 * @property int|null $8_kill_count
 * @property int|null $8_death_count
 * @property int|null $8_assists_count
 * @property int|null $7_accountid
 * @property int|null $7_heroid
 * @property int|null $7_kill_count
 * @property int|null $7_death_count
 * @property int|null $7_assists_count
 * @property int|null $6_accountid
 * @property int|null $6_heroid
 * @property int|null $6_kill_count
 * @property int|null $6_death_count
 * @property int|null $6_assists_count
 * @property int|null $5_accountid
 * @property int|null $5_heroid
 * @property int|null $5_kill_count
 * @property int|null $5_death_count
 * @property int|null $5_assists_count
 * @property int|null $4_accountid
 * @property int|null $4_heroid
 * @property int|null $4_kill_count
 * @property int|null $4_death_count
 * @property int|null $4_assists_count
 * @property int|null $3_accountid
 * @property int|null $3_heroid
 * @property int|null $3_kill_count
 * @property int|null $3_death_count
 * @property int|null $3_assists_count
 * @property int|null $2_accountid
 * @property int|null $2_heroid
 * @property int|null $2_kill_count
 * @property int|null $2_death_count
 * @property int|null $2_assists_count
 * @property int|null $1_accountid
 * @property int|null $1_heroid
 * @property int|null $1_kill_count
 * @property int|null $1_death_count
 * @property int|null $1_assists_count
 * @property int|null $0_accountid
 * @property int|null $0_heroid
 * @property int|null $0_kill_count
 * @property int|null $0_death_count
 * @property int|null $0_assists_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchPast where0Accountid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchPast where0AssistsCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchPast where0DeathCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchPast where0Heroid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchPast where0KillCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchPast where1Accountid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchPast where1AssistsCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchPast where1DeathCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchPast where1Heroid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchPast where1KillCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchPast where2Accountid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchPast where2AssistsCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchPast where2DeathCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchPast where2Heroid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchPast where2KillCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchPast where3Accountid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchPast where3AssistsCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchPast where3DeathCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchPast where3Heroid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchPast where3KillCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchPast where4Accountid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchPast where4AssistsCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchPast where4DeathCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchPast where4Heroid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchPast where4KillCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchPast where5Accountid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchPast where5AssistsCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchPast where5DeathCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchPast where5Heroid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchPast where5KillCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchPast where6Accountid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchPast where6AssistsCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchPast where6DeathCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchPast where6Heroid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchPast where6KillCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchPast where7Accountid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchPast where7AssistsCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchPast where7DeathCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchPast where7Heroid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchPast where7KillCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchPast where8Accountid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchPast where8AssistsCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchPast where8DeathCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchPast where8Heroid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchPast where8KillCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchPast where9Accountid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchPast where9AssistsCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchPast where9DeathCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchPast where9Heroid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchPast where9KillCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchPast whereLeagueId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchPast whereMAttempts($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchPast whereMatchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchPast whereSeriesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchPast whereTeam0($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchPast whereTeam0Name($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchPast whereTeam0Score($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchPast whereTeam1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchPast whereTeam1Name($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchPast whereTeam1Score($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchPast whereTimestamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchPast whereWinner($value)
 */
class MatchPast extends Model
{
    /**
     * @var string
     */
    protected $table = 'z11_dota2_matches_past';

    /**
     * @var string
     */
    protected $primaryKey = 'match_id';

    /**
     * The connection name for the model.
     *
     * @var string|null
     */
    protected $connection = "z11_dota2_main";

    public static function playerDataSql()
    {
        return "SELECT 
                p.name, p.account_id, p.age, p.position, t.team_name, t.team_id, t.country_code 
            FROM 
                `z11_dota2_history`.`z11_dota2_players` AS p,
                `z11_dota2_history`.`z11_dota2_teams` AS t
            WHERE
                `p`.`account_id` = ? AND `t`.`team_id` = `p`.`team_id`";
    }

    public static function matchesDataSql()
    {
        return "SELECT 
                * 
            FROM 
                `z11_dota2_main`.`z11_dota2_matches_past` 
            WHERE 
                `match_id` IN (SELECT `match_id` FROM `z11_dota2_main`.`z11_dota2_matches_past_2_players` WHERE `account_id`= ?) AND 
                winner IS NOT NULL 
            ORDER BY TIMESTAMP DESC";
    }
}
