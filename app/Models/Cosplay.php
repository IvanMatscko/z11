<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cosplay extends Model
{
    protected $guarded = [];

    protected $connection = 'z11_laravel';

    public static function scopeAction($q, $action, $order = 'updated_at')
    {
        return $q->where('action', $action)->latest($order);
    }
}
