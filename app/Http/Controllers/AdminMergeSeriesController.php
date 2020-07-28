<?php


namespace App\Http\Controllers;
      
// /*sockets*/
// require_once env('BASE_DIR').'/include/socket/vendor/autoload.php';
// use ElephantIO\Client;
// use ElephantIO\Engine\SocketIO\Version2X;

/*laravel modules*/
use App\Providers\RouteServiceProvider;
use App\Input\Admin\PastMatches;
use App\Input\Admin\LiveMatches;
use App\Input\Admin\MergeSeries;

class AdminMergeSeriesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function mergeSeries()
    {
        $liveMatches = LiveMatches::getMatchesLive(['`m`.match_id','`m`.team_name_radiant','`m`.team_name_dire','`m`.team_id_radiant','`m`.team_id_dire','`m`.building_state','`m`.league_id','`m`.MStatus','`m`.series_id', '`m`.activate_time'],'`MStatus` IN ('.env('MSTATUS_LIVE_GET_STATS_L').','.env('MSTATUS_LIVE_GET_STATS_TIME_START_L').')','activate_time',false,false);

        $pastMatches =  PastMatches::getMatchesPast([],'`d2mp`.`winner` IS NOT NULL','`d2mp`.`timestamp`',false,true);
        // var_dump($pastMatches);die;

        return view('admin/admin-merge-matches', [
            'data'=>[
                'route' => RouteServiceProvider::HOME, 
                'liveMatches' => $liveMatches,
                'pastMatches' => $pastMatches, 
            ]
        ]);
    }
    
    public function mergeSeriesWith($series_id)
    {
        $liveMatches = LiveMatches::getMatchesLive(['`m`.match_id','`m`.team_name_radiant','`m`.team_name_dire','`m`.team_id_radiant','`m`.team_id_dire','`m`.building_state','`m`.league_id','`m`.MStatus','`m`.series_id', '`m`.activate_time'],'`MStatus` IN ('.env('MSTATUS_LIVE_GET_STATS_L').','.env('MSTATUS_LIVE_GET_STATS_TIME_START_L').') AND `m`.`series_id` = '.$series_id, 'activate_time',false,false);

        $pastMatches =  PastMatches::getMatchesPast([],'`d2mp`.`winner` IS NOT NULL AND `d2mp`.`series_id` = '.$series_id, '`d2mp`.`timestamp`',false,true);
        // var_dump($pastMatches);die;
        $teams = [];
        if (!empty($liveMatches))
        {
            if ($liveMatches[0]->team_id_radiant)
                $teams[] = $liveMatches[0]->team_id_radiant;
            if ($liveMatches[0]->team_id_dire)
                $teams[] = $liveMatches[0]->team_id_dire;
        } else if (!empty($pastMatches))
        {
            if ($pastMatches[0]->team_0)
                $teams[] = $pastMatches[0]->team_0;
            if ($pastMatches[0]->team_1)
                $teams[] = $pastMatches[0]->team_1;
        }
        if (empty($teams))
            abort(404);
        $teams = implode(',',$teams);

        $mwliveMatches = LiveMatches::getMatchesLive(['`m`.match_id','`m`.team_name_radiant','`m`.team_name_dire','`m`.team_id_radiant','`m`.team_id_dire','`m`.building_state','`m`.league_id','`m`.MStatus','`m`.series_id', '`m`.activate_time'],'`MStatus` IN ('.env('MSTATUS_LIVE_GET_STATS_L').','.env('MSTATUS_LIVE_GET_STATS_TIME_START_L').') AND `m`.`series_id` <> '.$series_id.' AND `m`.`team_id_radiant` IN ('.$teams.') AND `m`.`team_id_dire` IN ('.$teams.')', 'activate_time',false,false);;

        $mwpastMatches = PastMatches::getMatchesPast([],'`d2mp`.`winner` IS NOT NULL AND `d2mp`.`series_id` <> '.$series_id.' AND `d2mp`.`team_0` IN ('.$teams.') AND `d2mp`.`team_1` IN ('.$teams.')', '`d2mp`.`timestamp`',false,true);


        return view('admin/admin-merge-matches-with', [
            'data'=>[
                'route' => RouteServiceProvider::HOME, 
                'liveMatches' => $liveMatches,
                'pastMatches' => $pastMatches, 
                'mwliveMatches' => $mwliveMatches,
                'mwpastMatches' => $mwpastMatches, 
                'series_id' => $series_id,
            ]
        ]);
    }

    public function mergeSeriesWithThis($series_id, $second_series_id)
    {
        if (!is_numeric($series_id) || $series_id < 0)
            die();
        $series_id = (int)$series_id;
        if (!is_numeric($second_series_id) || $second_series_id < 0)
            die();
        $second_series_id = (int)$second_series_id;

        $res = MergeSeries::mergeSeries($series_id, $second_series_id);

        return redirect(RouteServiceProvider::HOME.'/merge_series')
        ->withInput();
    }

}
