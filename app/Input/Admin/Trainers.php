<?php

namespace App\Input\Admin;
use Illuminate\Support\Facades\DB;

/**
 * App\Trainer
 *
 * @property int $trainer_id
 * @property string|null $name
 * @property int|null $team_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Trainer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Trainer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Trainer query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Trainer whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Trainer whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Trainer whereTrainerId($value)
 * @mixin \Eloquent
 */
class Trainers {
    
    public static function getTrainers($columns = [], $whereSQL = false, $order = false, $limitValue = false)
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
            `z11_dota2_trainers` 
        WHERE '.$where.$orderby.$limit);
        return $res;
    }
}