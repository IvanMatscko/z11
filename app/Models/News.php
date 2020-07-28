<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';

    protected $connection = 'z11_laravel';

    protected $guarded = [];

    public function scopeActive($q)
    {
        return $q->where('active', 1);
    }

    public function scopeFilter($q, $data)
    {
        if ( isset($data['lang']['ru']))
            $q->where('locale', 'ru')->whereIn('game', array_keys($data['ru'] ?? []));
        if ( isset($data['lang']['en']))
        {
            isset($data['lang']['ru'])
                ? $q->orWhere('locale', 'en')
                : $q->where('locale', 'en');

                $q->whereIn('game', array_keys($data['en'] ?? []));
        }
        return $q;
    }

    public function scopeFor($q, $type)
    {
        /*
         * $type =
         * actual -> for this day
         * past -> for lats week
         */

        if ($type == 'actual')
            $q->where('post_created', '>', strtotime(date('Y-m-d')));
        if ($type == 'past')
            $q->where('post_created', '>', strtotime(date('Y-m-d', strtotime('-1 week'))));

        return $q;
    }

    public function newsSource()
    {
        return $this->belongsTo(NewsSource::class, 'chanel_id');
    }
}
