<?php

namespace App\Http\Controllers;

use App\Custom\Common;
use App\Models\News;
use App\Models\NewsBan;
use App\Models\NewsSource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $language_block = Common::prepareLanguageBlock();
        $search_block = Common::prepareSearchBlock();

        $tgNewsActual = News::where('source', 'tg')->active()->filter($request->all())->for('actual')->with('newsSource')->limit(10)->get();
        $twNewsActual = News::where('source', 'tw')->active()->filter($request->all())->for('actual')->with('newsSource')->limit(10)->get();

        $tgNewsPast = News::where('source', 'tg')->active()->filter($request->all())->for('past')->with('newsSource')->limit(10)->get();
        $twNewsPast = News::where('source', 'tw')->active()->filter($request->all())->for('past')->with('newsSource')->limit(10)->get();

        //DEBUG QUERY
//        DB::enableQueryLog();
//        News::where('source', 'tw')->active()->filter($request->all())->where('post_created', '>', strtotime(date('Y-m-d')))->limit(10)->get();
//        dd(DB::getQueryLog());


//        dd( News::active()->filter($request->all())->get() );

//        dd($tgNews);

        return view('pages.news', [
            'search_block' => $search_block,
            'language_block' => $language_block,
            'tgNews' => $tgNewsActual,
            'twNews' => $twNewsActual,
            'tgNewsPast' => $tgNewsPast,
            'twNewsPast' => $twNewsPast
        ]);
    }



    //ADMIN PART START

    public function indexAdmin()
    {
        $sources_banned = NewsBan::latest()->paginate();
        $sources = NewsSource::latest()->paginate();

        return view('admin.news.index', [
            'sources' => $sources,
            'sourcesBanned' => $sources_banned,
        ]);
    }

    public function edit(NewsSource $source)
    {
        return view('admin.news.edit', [
            'source' => $source
        ]);
    }

    public function editBan(NewsBan $source)
    {
        return view('admin.news.edit-ban', [
            'source' => $source
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->except(['source_id', '_token']);

        isset($request->source_id)
            ? NewsSource::find($request->source_id)->update($data)
            : NewsSource::create($data);

        return redirect( route('news.admin.index'));
    }

    public function storeBan(Request $request)
    {
        NewsBan::create($request->all());

        return redirect( route('news.admin.index'));
    }

    public function ban(NewsSource $source)
    {
        NewsBan::firstOrCreate(['name' => $source->source]);
        return back();
    }

    public function destroy(NewsSource $source)
    {
        $source->delete();
        return back();
    }

    public function destroyBan(NewsBan $source)
    {
        $source->delete();
        return back();
    }
}
