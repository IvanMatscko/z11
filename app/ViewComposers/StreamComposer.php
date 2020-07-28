<?php

namespace App\ViewComposers;

use Illuminate\View\View;
use App\Stream;

class StreamComposer
{
    protected $stream;

    public function __construct(Stream $stream)
    {
        $this->stream = $stream;
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
        $stream = $this->stream->statusOn()->orderByDesc('id')->first();

        $view->with('stream', $stream);
    }
}
