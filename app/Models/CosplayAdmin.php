<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CosplayAdmin extends Model
{
    protected $table = 'cosplays_admin';

    protected $guarded = [];

    protected $connection = 'z11_laravel';
}
