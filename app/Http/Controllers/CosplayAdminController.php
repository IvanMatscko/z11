<?php

namespace App\Http\Controllers;

use InstagramScraper\Instagram;
use App\Models\Cosplay;
use Illuminate\Http\Request;
use Phpfastcache\Helper\Psr16Adapter;

class CosplayAdminController extends Controller
{
    public function index()
    {
        $imagesNew = Cosplay::action('created', 'created_at')->paginate();
        $imagesSaved = Cosplay::action('saved')->limit(81)->paginate(15, ['*'], 'saved_image_page');

        return view('admin.cosplay.index', [
            'imagesNew' => $imagesNew,
            'imagesSaved' => $imagesSaved,
        ]);
    }

    public function edit(Cosplay $cosplay, $action)
    {
        $cosplay->action = $action;
        $cosplay->save();

        return back();
    }
}
