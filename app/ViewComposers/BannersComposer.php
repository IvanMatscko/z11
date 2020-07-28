<?php

namespace App\ViewComposers;

use Illuminate\View\View;
use App\Banner;

class BannersComposer
{
    protected $banner;

    /**
     * BannersComposer constructor.
     *
     * @param \App\Banner $banner
     */
    public function __construct(Banner $banner)
    {
        $this->banner = $banner;
    }

    /**
     * Bind data to the view.
     *
     * @param View $view
     *
     * @return void
     */
    public function compose(View $view)
    {
        $banners = $this->banner->all();

        $view->with('banners', $banners);
    }
}
