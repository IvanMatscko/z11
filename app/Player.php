<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Player
 *
 * @property int $account_id
 * @property string|null $name
 * @property int|null $position
 * @property int|null $cash
 * @property bool|null $age
 * @property int $team_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Player newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Player newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Player query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Player whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Player whereAge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Player whereCash($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Player whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Player wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Player whereTeamId($value)
 * @mixin \Eloquent
 * @property-read \App\Team|null $team
 */
class Player extends Model
{
    public const PLAYER_CARRY     = 1;

    public const PLAYER_MID       = 2;

    public const PLAYER_OFFLANER  = 3;

    public const PLAYER_SUPPORT_4 = 4;

    public const PLAYER_SUPPORT_5 = 5;

    /**
     * @var string
     */
    protected $table = 'z11_dota2_players';

    /**
     * @var string
     */
    protected $primaryKey = 'account_id';

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

    /**
     * @var bool
     */
    public $timestamps = false;

    public $fillable = [
        'account_id',
        'name',
        'position',
        'age',
        'team_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function team()
    {
        return $this->hasOne(Team::class, 'team_id', 'team_id');
    }

    public static function player_positions()
    {
        return [
            self::PLAYER_CARRY     => __('l.positions.carry'),
            self::PLAYER_MID       => __('l.positions.mid'),
            self::PLAYER_OFFLANER  => __('l.positions.offlaner'),
            self::PLAYER_SUPPORT_4 => __('l.positions.support_4'),
            self::PLAYER_SUPPORT_5 => __('l.positions.support_5'),
        ];
    }

    /**
     * @param array $data
     *
     * @return \App\Player|\Illuminate\Database\Eloquent\Model
     */
    public static function create_player(array $data)
    {
        return static::create([
            'account_id' => $data['account_id'],
            'name'       => $data['player_name'],
            'age'        => $data['age'],
            'position'   => $data['position'],
            'team_id'    => $data['team_id'],
        ]);
    }

    /**
     * @param array $data
     *
     * @return bool
     */
    public function update_player(array $data)
    {
        return $this->update([
            'account_id' => $data['account_id'],
            'name'       => $data['player_name'],
            'age'        => $data['age'],
            'position'   => $data['position'],
            'team_id'    => $data['team_id'],
        ]);
    }
}
