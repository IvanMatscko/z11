<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * App\Stream
 *
 * @property int $id
 * @property string $channel
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Stream newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Stream newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Stream query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Stream whereChannel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Stream whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Stream whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Stream whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Stream whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Stream statusOn()
 */
class Stream extends Model
{
    public const STREAM_ON  = 1;

    public const STREAM_OFF = 0;

    /**
     * @var string
     */
    protected $table = 'streams';

    /**
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'channel',
        'status',
    ];

    public static function list_status()
    {
        return [
            self::STREAM_ON  => trans('l.stream.status_on'),
            self::STREAM_OFF => trans('l.stream.status_off'),
        ];
    }

    /**
     * @param $stream
     *
     * @return \App\Stream|\Illuminate\Database\Eloquent\Model
     */
    public static function create_stream($stream)
    {
        return static::create([
            'channel' => $stream['channel'],
            'status'  => $stream['status'],
        ]);
    }

    /**
     * @param $stream
     *
     * @return bool
     */
    public function update_stream($stream)
    {
        return $this->update([
            'channel' => $stream['channel'],
            'status'  => $stream['status'],
        ]);
    }

    /**
     * @param $status
     */
    public function update_status($status)
    {
        $this->update([
            'status' => $status,
        ]);
    }

    /**
     * Scope a query to only include active users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeStatusOn($query)
    {
        return $query->where('status', self::STREAM_ON);
    }

    /*
    *
    */
    public static function getAllStreams()
    {
        $res = DB::connection('z11_laravel')->select('SELECT 
            * 
        FROM
            `streams` 
        WHERE 1');
        return $res;
    }
}
