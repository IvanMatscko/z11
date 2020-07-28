<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Team
 *
 * @property int $team_id
 * @property string|null $team_name
 * @property string|null $team_tag
 * @property int|null $team_logo
 * @property string|null $team_logo_url
 * @property string|null $filename
 * @property string|null $country_code
 * @property int|null $logo_sponsor
 * @property int|null $player_0_account_id
 * @property int|null $player_1_account_id
 * @property int|null $player_2_account_id
 * @property int|null $player_3_account_id
 * @property int|null $player_4_account_id
 * @property int|null $player_5_account_id
 * @property int|null $admin_account_id
 * @property int|null $time_created
 * @property bool|null $TStatus
 * @property bool|null $display
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereAdminAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereCountryCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereDisplay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereFilename($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereLogoSponsor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team wherePlayer0AccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team wherePlayer1AccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team wherePlayer2AccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team wherePlayer3AccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team wherePlayer4AccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team wherePlayer5AccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereTStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereTeamLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereTeamLogoUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereTeamName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereTeamTag($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereTimeCreated($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Player[] $team_players
 * @property-read int|null $team_players_count
 */
class Team extends Model
{
    /**
     * @var string
     */
    protected $table = 'z11_dota2_teams';

    /**
     * @var string
     */
    protected $primaryKey = 'team_id';

    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * The connection name for the model.
     *
     * @var string|null
     */
    protected $connection = "z11_dota2_history";

    public $fillable = [
        'team_id',
        'team_name',
        'team_tag',
        'team_logo',
        'team_logo_url',
        'country_code',
        'player_0_account_id',
        'player_1_account_id',
        'player_2_account_id',
        'player_3_account_id',
        'player_4_account_id',
        'player_5_account_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function team_players()
    {
        return $this->hasMany(Player::class, 'team_id', 'account_id');
    }

    public function players()
    {
        return $this->hasMany(Player::class, 'team_id', 'team_id');
    }
}
