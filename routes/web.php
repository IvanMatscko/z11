<?php

use App\Http\Controllers\NewsController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\ChatCensorController;
use App\Http\Controllers\CosplayAdminController;
use App\Http\Controllers\TeamController;
use App\Models\ChatCensor;
use App\Models\Cosplay;
use App\Models\NewsSource;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use InstagramScraper\Instagram;
use Phpfastcache\Helper\Psr16Adapter;
use Symfony\Component\HttpFoundation\Response;
use App\Custom\Language;
use App\Custom\Common;
use Illuminate\Support\Facades\Request;
use App\Providers\RouteServiceProvider;


function test_print($item)
{
    return "/\b$item\b/i";
}

Route::any('/test', function (\Illuminate\Http\Request $request) {

    $string = 'nu ti i suka';

    $words = ChatCensor::all();
    $badWords = array_map('test_print', $words->pluck('from')->toArray());
    $goodWords = $words->pluck('to')->toArray();

    $string = preg_replace(
        $badWords,
        $goodWords,
        $string);

    dd( $string );
//    dd( $try );

//    $settings = array(
//        'oauth_access_token' => "1278812664026841088-SB1U2d8yl51P0sSPw4g2GmhZ0bCAoF",
//        'oauth_access_token_secret' => "tJaO4sI0WjVfOsDzgjyWxkKttab9SF8Q1VtAoihoimO63",
//        'consumer_key' => "reEgJbr1rRCdb6yOfEOtGyaBC",
//        'consumer_secret' => "H01XzoZgz4pfSBZE2qT6M7lOD4rWwtbgA2tJbVZa3zooislN2Z"
//    );
//    $url = 'https://api.twitter.com/1.1/statuses/home_timeline.json';
//    $getfield = '?include_entities=false&&count=50';
//    $requestMethod = 'GET';
//
//    $twitter = new TwitterAPIExchange($settings);
//    dd( json_decode($twitter->setGetfield($getfield)
//        ->buildOauth($url, $requestMethod)
//        ->performRequest(), true) );
});

Route::redirect('/', '/ru');
// Route::redirect('/home', '/en/home');
Route::get('/graph_popup', 'MainController@graphPopup')->name('graph_popup');

Route::group(['prefix' => 'chat', 'as' => 'chat.'], function () {
    Route::get('/', [ChatController::class, 'index']);
    Route::post('/login', [ChatController::class, 'saveUser'])->name('login');
    Route::get('/logout', [ChatController::class, 'logout'])->name('logout');
});
Route::resource('chat', 'ChatController');


Route::get(RouteServiceProvider::HOME.'/cosplay/{cosplay}/{action}', [CosplayAdminController::class, 'edit'])->name('admin.cosplay.edit')->middleware('auth');
Route::resource(RouteServiceProvider::HOME.'/cosplay', 'CosplayAdminController')->only(['index', 'store'])->middleware('auth');

Route::group(['prefix'=>'{language}'], function () {
    Route::resource('cosplay', 'CosplayController');
});

Route::get(RouteServiceProvider::HOME.'/news', [NewsController::class, 'indexAdmin'])->name('news.admin.index')->middleware('auth');
Route::get(RouteServiceProvider::HOME.'/news/create', [NewsController::class, 'edit'])->name('news.admin.create')->middleware('auth');
Route::get(RouteServiceProvider::HOME.'/news/create-ban', [NewsController::class, 'editBan'])->name('news.admin.create-ban')->middleware('auth');
Route::post(RouteServiceProvider::HOME.'/news/store-ban', [NewsController::class, 'storeBan'])->name('news.admin.store-ban')->middleware('auth');
Route::get(RouteServiceProvider::HOME.'/news/{source}/edit', [NewsController::class, 'edit'])->name('news.admin.edit')->middleware('auth');
Route::get(RouteServiceProvider::HOME.'/news/{source}/ban', [NewsController::class, 'ban'])->name('news.admin.ban')->middleware('auth');
Route::get(RouteServiceProvider::HOME.'/news/{source}/destroy', [NewsController::class, 'destroy'])->name('news.admin.destroy')->middleware('auth');
Route::get(RouteServiceProvider::HOME.'/news/{source}/destroy-ban', [NewsController::class, 'destroyBan'])->name('news.admin.destroy-ban')->middleware('auth');
Route::resource(RouteServiceProvider::HOME.'/news', 'NewsController')->except(['index', 'create'])->middleware('auth');
Route::group(['prefix'=>'{language}'], function () {
    Route::resource('news', 'NewsController')->only('index');
});


Route::get(RouteServiceProvider::HOME.'/bwords/{bword}/delete', [ChatCensorController::class, 'destroy'])->name('bwords.destroy')->middleware('auth');
Route::resource(RouteServiceProvider::HOME.'/bwords', 'ChatCensorController')->except(['update', 'destroy', 'show'])->middleware('auth');
//
//Route::group(['prefix' => RouteServiceProvider::HOME.'/bwords', 'as' => 'bwords.'], function () {
//    Route::get('/', [ChatCensorController::class, 'index']);
//    Route::post('/store', [ChatCensorController::class, 'store'])->name('store');
//});


//Auth::routes();
// Authentication Routes...
Route::get('/72632a478b5a11cfe49e8ace30fe8951', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/72632a478b5a11cfe49e8ace30fe8951', 'Auth\LoginController@login');
//Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
 Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
 Route::post('/register', 'Auth\RegisterController@register');


Route::get(RouteServiceProvider::HOME, 'AuthController@globalConfigurations')->name('admin')->middleware('check_user_role:' . \App\Role\UserRole::ROLE_ADMIN);
Route::post(RouteServiceProvider::HOME, 'AuthController@inputGlobalConfigurations')->name('admin')->middleware('check_user_role:' . \App\Role\UserRole::ROLE_ADMIN);
Route::get(RouteServiceProvider::HOME.'/past_matches', 'AdminPastMatchesController@pastMatches')->name('admin')->middleware('check_user_role:' . \App\Role\UserRole::ROLE_ADMIN);
Route::get(RouteServiceProvider::HOME.'/past_matches/edit/{match_id}', 'AdminPastMatchesController@pastMatchesEdit')->name('admin')->middleware('check_user_role:' . \App\Role\UserRole::ROLE_ADMIN);
Route::post(RouteServiceProvider::HOME.'/past_matches/edit/{match_id}', 'AdminPastMatchesController@inputPastMatchesEdit')->name('admin')->middleware('check_user_role:' . \App\Role\UserRole::ROLE_ADMIN);
Route::get(RouteServiceProvider::HOME.'/past_matches/delete/{match_id}', 'AdminPastMatchesController@pastMatchesDelete')->name('admin')->middleware('check_user_role:' . \App\Role\UserRole::ROLE_ADMIN);
Route::get(RouteServiceProvider::HOME.'/live_matches', 'AdminLiveMatchesController@liveMatches')->name('admin')->middleware('check_user_role:' . \App\Role\UserRole::ROLE_ADMIN);
Route::get(RouteServiceProvider::HOME.'/live_matches/edit/{match_id}', 'AdminLiveMatchesController@liveMatchesEdit')->name('admin')->middleware('check_user_role:' . \App\Role\UserRole::ROLE_ADMIN);
Route::post(RouteServiceProvider::HOME.'/live_matches/edit/{match_id}', 'AdminLiveMatchesController@inputLiveMatchesEdit')->name('admin')->middleware('check_user_role:' . \App\Role\UserRole::ROLE_ADMIN);
Route::get(RouteServiceProvider::HOME.'/live_matches/close/{match_id}', 'AdminLiveMatchesController@liveMatchesClose')->name('admin')->middleware('check_user_role:' . \App\Role\UserRole::ROLE_ADMIN);
Route::get(RouteServiceProvider::HOME.'/live_matches/delete/{match_id}', 'AdminLiveMatchesController@liveMatchesDelete')->name('admin')->middleware('check_user_role:' . \App\Role\UserRole::ROLE_ADMIN);
Route::get(RouteServiceProvider::HOME.'/future_matches', 'AdminFutureMatchesController@futureMatches')->name('admin')->middleware('check_user_role:' . \App\Role\UserRole::ROLE_ADMIN);
Route::post(RouteServiceProvider::HOME.'/future_matches', 'AdminFutureMatchesController@inputFutureMatches')->name('admin')->middleware('check_user_role:' . \App\Role\UserRole::ROLE_ADMIN);
Route::get(RouteServiceProvider::HOME.'/future_matches/add', 'AdminFutureMatchesController@futureMatchesAdd')->name('admin')->middleware('check_user_role:' . \App\Role\UserRole::ROLE_ADMIN);
Route::post(RouteServiceProvider::HOME.'/future_matches/add', 'AdminFutureMatchesController@inputFutureMatchesAdd')->name('admin')->middleware('check_user_role:' . \App\Role\UserRole::ROLE_ADMIN);
Route::get(RouteServiceProvider::HOME.'/future_matches/del/{MFID}', 'AdminFutureMatchesController@delFutureMatch')->name('admin')->middleware('check_user_role:' . \App\Role\UserRole::ROLE_ADMIN);
Route::get(RouteServiceProvider::HOME.'/merge_series', 'AdminMergeSeriesController@mergeSeries')->name('admin')->middleware('check_user_role:' . \App\Role\UserRole::ROLE_ADMIN);
Route::get(RouteServiceProvider::HOME.'/merge_series/merge/{series_id}', 'AdminMergeSeriesController@mergeSeriesWith')->name('admin')->middleware('check_user_role:' . \App\Role\UserRole::ROLE_ADMIN);
Route::get(RouteServiceProvider::HOME.'/merge_series/merge_with/{series_id}/{second_series_id}', 'AdminMergeSeriesController@mergeSeriesWithThis')->name('admin')->middleware('check_user_role:' . \App\Role\UserRole::ROLE_ADMIN);

Route::get(RouteServiceProvider::HOME.'/countries', 'AuthController@countries')->name('admin')->middleware('check_user_role:' . \App\Role\UserRole::ROLE_ADMIN);
Route::get(RouteServiceProvider::HOME.'/heroes', 'AuthController@heroes')->name('admin')->middleware('check_user_role:' . \App\Role\UserRole::ROLE_ADMIN);
Route::get(RouteServiceProvider::HOME.'/trainers', 'AuthController@trainers')->name('admin')->middleware('check_user_role:' . \App\Role\UserRole::ROLE_ADMIN);
Route::get(RouteServiceProvider::HOME.'/teams', 'AdminTeamsController@teams')->name('admin')->middleware('check_user_role:' . \App\Role\UserRole::ROLE_ADMIN);
Route::post(RouteServiceProvider::HOME.'/teams', 'AdminTeamsController@inputTeams')->name('admin')->middleware('check_user_role:' . \App\Role\UserRole::ROLE_ADMIN);
Route::get(RouteServiceProvider::HOME.'/teams/add', 'AdminTeamsController@teamsAdd')->name('admin')->middleware('check_user_role:' . \App\Role\UserRole::ROLE_ADMIN);
Route::post(RouteServiceProvider::HOME.'/teams/add', 'AdminTeamsController@inputTeamsAdd')->name('admin')->middleware('check_user_role:' . \App\Role\UserRole::ROLE_ADMIN);
Route::get(RouteServiceProvider::HOME.'/teams/edit', 'AdminTeamsController@teamsEditBlank')->name('admin')->middleware('check_user_role:' . \App\Role\UserRole::ROLE_ADMIN);
Route::post(RouteServiceProvider::HOME.'/teams/edit', 'AdminTeamsController@inputTeamsEditBlank')->name('admin')->middleware('check_user_role:' . \App\Role\UserRole::ROLE_ADMIN);
Route::get(RouteServiceProvider::HOME.'/teams/edit/{team_id}', 'AdminTeamsController@teamsEdit')->name('admin')->middleware('check_user_role:' . \App\Role\UserRole::ROLE_ADMIN);
Route::post(RouteServiceProvider::HOME.'/teams/edit/{team_id}', 'AdminTeamsController@inputTeamsEdit')->name('admin')->middleware('check_user_role:' . \App\Role\UserRole::ROLE_ADMIN);
Route::get(RouteServiceProvider::HOME.'/leagues', 'AdminLeaguesController@leagues')->name('leagues.index')->middleware('check_user_role:' . \App\Role\UserRole::ROLE_ADMIN);
Route::get(RouteServiceProvider::HOME.'/leagues/add', 'AdminLeaguesController@leaguesAdd')->name('leagues.add')->middleware('check_user_role:' . \App\Role\UserRole::ROLE_ADMIN);
Route::post(RouteServiceProvider::HOME.'/leagues/add', 'AdminLeaguesController@inputLeaguesAdd')->name('leagues.addPost')->middleware('check_user_role:' . \App\Role\UserRole::ROLE_ADMIN);
Route::get(RouteServiceProvider::HOME.'/leagues/edit/{LID}', 'AdminLeaguesController@leaguesEdit')->where('LID', '[0-9]+')->name('leagues.edit')->middleware('check_user_role:' . \App\Role\UserRole::ROLE_ADMIN);
Route::post(RouteServiceProvider::HOME.'/leagues/edit/{LID}', 'AdminLeaguesController@inputLeaguesEdit')->where('LID', '[0-9]+')->name('leagues.editPost')->middleware('check_user_role:' . \App\Role\UserRole::ROLE_ADMIN);
Route::get(RouteServiceProvider::HOME.'/leagues/del/{LID}', 'AdminLeaguesController@delLeague')->where('LID', '[0-9]+')->name('leagues.delete')->middleware('check_user_role:' . \App\Role\UserRole::ROLE_ADMIN);


Route::group(['prefix' => RouteServiceProvider::HOME, 'namespace' => 'Admin', 'middleware' => ['check_user_role:' . \App\Role\UserRole::ROLE_ADMIN]], function () {

    Route::group(['prefix' => 'banners'], function () {
        Route::get('/', 'BannerController@index')->name('banners.index');
        Route::get('/create', 'BannerController@create')->name('banners.create');
        Route::post('/', 'BannerController@store')->name('banners.store');
        Route::get('/{banner}/edit', 'BannerController@edit')->name('banners.edit');
        Route::post('/{banner}/update', 'BannerController@update')->name('banners.update');
        Route::get('/{banner}/destroy', 'BannerController@destroy')->name('banners.destroy');
    });

    Route::group(['prefix' => 'streams'], function () {
        Route::get('/', 'StreamController@index')->name('streams.index');
        Route::get('/create', 'StreamController@create')->name('streams.create');
        Route::post('/', 'StreamController@store')->name('streams.store');
        Route::get('/{stream}/edit', 'StreamController@edit')->name('streams.edit');
        Route::post('/{stream}/update', 'StreamController@update')->name('streams.update');
        Route::get('/{stream}/destroy', 'StreamController@destroy')->name('streams.destroy');
        Route::get('/{stream}/status', 'StreamController@status')->name('streams.status');
    });

    Route::group(['prefix' => 'players'], function () {
        Route::get('/', 'PlayerController@index')->name('players.index');
        Route::get('/create', 'PlayerController@create')->name('players.create');
        Route::post('/', 'PlayerController@store')->name('players.store');
        Route::get('/{player}/edit', 'PlayerController@edit')->name('players.edit');
        Route::post('/{player}/update', 'PlayerController@update')->name('players.update');
        Route::get('/{player}/destroy', 'PlayerController@destroy')->name('players.destroy');
    });
});


//Route::get(RouteServiceProvider::HOME . '/streams', 'AuthController@streams')->name('admin')->middleware('check_user_role:' . \App\Role\UserRole::ROLE_ADMIN);
//Route::get(RouteServiceProvider::HOME.'/banners', 'AuthController@banners')->name('admin')->middleware('check_user_role:' . \App\Role\UserRole::ROLE_ADMIN);
Route::get(RouteServiceProvider::HOME . '/users', 'AuthController@users')->name('admin')->middleware('check_user_role:' . \App\Role\UserRole::ROLE_ADMIN);
Route::get(RouteServiceProvider::HOME . '/coefficients', 'AuthController@coefficients')->name('admin')->middleware('check_user_role:' . \App\Role\UserRole::ROLE_ADMIN);


Route::get('/channel/{channel_id}', 'MainController@channel');

Route::group(['prefix'=>'{language}'], function () {

    $pathParts = Common::parsePath(Request::path());
    //check language param BEGIN
    if (!Language::checkLocale($pathParts[0]))
        return Response::create(Response::$statusTexts[Response::HTTP_NOT_FOUND],Response::HTTP_NOT_FOUND);
    //check language param END

    Route::get('/', 'MainController@main')->name('main');
    Route::get('/search', 'AdditionalPagesController@emptySearch')->name('search');
    Route::post('/search', 'AdditionalPagesController@search')->name('search');
    Route::get('/results', 'AdditionalPagesController@results')->name('main.results');
    Route::get('/schedule', 'AdditionalPagesController@schedule')->name('main.schedule');
    Route::get('/teams', [TeamController::class, 'index'])->name('teams');
    Route::get('/team/{team_id}', [TeamController::class, 'show'])->where('team_id', '[0-9]+');
    Route::get('/players', [PlayerController::class, 'index'])->name('players');
    Route::get('/player/{player_id}', [PlayerController::class, 'show'])->where('player_id', '[0-9]+');
    Route::get('/tournament/{tournament_id?}', 'AdditionalPagesController@tournament')->where('tournament_id', '[0-9]+')->name('tournament');
    Route::get('/league/{league_id}', 'AdditionalPagesController@league')->where('league_id', '[0-9]+')->name('league');


});
