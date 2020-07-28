<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\MatchFuture
 *
 * @property int $MFID
 * @property int|null $match_id
 * @property int|null $team_0
 * @property string|null $team_0_name
 * @property int|null $team_1
 * @property string|null $team_1_name
 * @property int|null $start_datetime
 * @property int|null $league_id
 * @property int|null $timestamp
 * @property bool|null $display
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchFuture newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchFuture newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchFuture query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchFuture whereDisplay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchFuture whereLeagueId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchFuture whereMFID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchFuture whereMatchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchFuture whereStartDatetime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchFuture whereTeam0($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchFuture whereTeam0Name($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchFuture whereTeam1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchFuture whereTeam1Name($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchFuture whereTimestamp($value)
 * @mixin \Eloquent
 */
class MatchFuture extends Model
{
    /**
     * @var string
     */
    protected $table = 'z11_dota2_matches_future';

    /**
     * @var string
     */
    protected $primaryKey = 'trainer_id';

    /**
     * The connection name for the model.
     *
     * @var string|null
     */
    protected $connection = "z11_dota2_main";
}
