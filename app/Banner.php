<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Banner
 *
 * @property int $id
 * @property string $title
 * @property string $link
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Banner newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Banner newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Banner query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Banner whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Banner whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Banner whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Banner whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Banner whereTheme($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Banner whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Banner whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $image_dark
 * @property string $image_white
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Banner whereImageDark($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Banner whereImageWhite($value)
 */
class Banner extends Model
{
    /**
     * @var string
     */
    protected $table = 'banners';

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
        'image_dark',
        'image_white',
        'title',
        'link',
    ];

    /**
     * @param string $image_dark
     * @param string $image_white
     * @param array $banner
     *
     * @return \App\Banner|\Illuminate\Database\Eloquent\Model
     */
    public static function create_banner(string $image_dark, string $image_white, array $banner)
    {
        return static::create([
            'image_dark'  => $image_dark,
            'image_white' => $image_white,
            'title'       => $banner['title'],
            'link'        => $banner['link'],
        ]);
    }

    /**
     * @param array $banner
     *
     * @return bool
     */
    public function update_banner(array $banner)
    {
        return $this->update([
            'image_dark'  => $banner['image_dark'],
            'image_white' => $banner['image_white'],
            'title'       => $banner['title'],
            'link'        => $banner['link'],
        ]);
    }

    /**
     * @return string
     */
    public function path_to_image_dark()
    {
        return '/img/banners/' . $this->image_dark;
    }

    /**
     * @return string
     */
    public function path_to_image_white()
    {
        return '/img/banners/' . $this->image_white;
    }
}
