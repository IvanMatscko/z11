<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $table = 'chat';

    protected $connection = 'z11_laravel';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'login', 'login');
    }

    public function isAdmin()
    {
        return $this->user && $this->user->role >= 50;
    }
}
