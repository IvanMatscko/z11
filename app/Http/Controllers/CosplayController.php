<?php

namespace App\Http\Controllers;

use App\Custom\Common;
use App\Models\Cosplay;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;
use Phpfastcache\Helper\Psr16Adapter;
use Illuminate\Http\Request;

class CosplayController extends Controller
{
    public function index()
    {
        $cosplays = Cosplay::action('saved')->limit(81)->get();
        $cosplaysBest = Cosplay::orderByDesc('likes')->limit(81)->get();
        $cookieCosplay = json_decode(Cookie::get('cosplay'), true);

        $cosplaysForPoll = $cosplays->sortBy('id')->pluck('origin_url', 'id');

//        dd( json_encode($cosplaysForPoll, true));


//        dd($cookieCosplay);

        $language_block = Common::prepareLanguageBlock();
        $search_block = Common::prepareSearchBlock();

        return view('pages.cosplay', [
            'search_block' => $search_block,
            'language_block' => $language_block,
            'cosplays' => $cosplays,
            'cosplaysBest' => $cosplaysBest,
            'cookieCosplay' => $cookieCosplay,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'image' => ['required', 'integer'],
            'type' => ['required', 'in:like,dislike'],
            'isPoll' => ['required', 'in:true,false'],
        ])->validate();

        $cosplay = Cosplay::find($request->image);

        $request->type == 'like'
            ? $cosplay->likes += 1
            : $cosplay->likes -= 1;

        $cosplay->timestamps = false;
        $cosplay->save();

            $cookie = Cookie::get('cosplay');
            $cookie = json_decode($cookie, true);
            $cookie[$cosplay->id] = $request->type;

//        dd($cookie);

            $cookie = json_encode($cookie);

        if ($request->isPoll == 'false')
            Cookie::queue('cosplay', $cookie, 9999);

        return Cookie::get('cosplay');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cosplay  $cosplay
     * @return \Illuminate\Http\Response
     */
    public function show(Cosplay $cosplay)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cosplay  $cosplay
     * @return \Illuminate\Http\Response
     */
    public function edit(Cosplay $cosplay)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cosplay  $cosplay
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cosplay $cosplay)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cosplay  $cosplay
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cosplay $cosplay)
    {
        //
    }
}
