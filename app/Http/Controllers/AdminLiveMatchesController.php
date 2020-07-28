<?php


namespace App\Http\Controllers;
      
// /*sockets*/
// require_once env('BASE_DIR').'/include/socket/vendor/autoload.php';
// use ElephantIO\Client;
// use ElephantIO\Engine\SocketIO\Version2X;

/*laravel modules*/
use App\Stream;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use App\Input\Admin\LiveMatches;

class AdminLiveMatchesController extends Controller
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

    
    public function liveMatches()
    {
        $liveMatches = LiveMatches::getMatchesLive(['`m`.match_id','`m`.team_name_radiant','`m`.team_name_dire','`m`.team_id_radiant','`m`.team_id_dire','`m`.building_state','`m`.league_id','`m`.MStatus'],'`m`.`team_name_radiant` IS NOT NULL AND `m`.`team_name_dire` IS NOT NULL','activate_time',false,false);

        return view('admin/admin-live-matches', [
            'data'=>[
                'route' => RouteServiceProvider::HOME,  
                'liveMatches' => $liveMatches, 
            ]
        ]);
    }
    
    public function liveMatchesEdit($match_id)
    {
        if (!is_numeric($match_id) || $match_id < 0)
            die();
        $match_id = (int)$match_id;
        $liveMatch = LiveMatches::getMatchesLive(['`m`.match_id','`m`.team_name_radiant','`m`.team_name_dire','`m`.team_id_radiant','`m`.team_id_dire','`m`.`MStreamID`'],'`m`.`match_id` = '.$match_id,'activate_time',false,false);
        $liveMatch = $liveMatch ? $liveMatch[0] : false;
        if (!$liveMatch)
        {
            $validator = Validator::make(['match_id' => $match_id],['match_id' => 'nullable|int']);
            $validator->errors()->add('match_id', 'Not exists.');
            return redirect(RouteServiceProvider::HOME.'/live_matches/add')
                        ->withErrors($validator)
                        ->withInput();

        }
        $streams = Stream::getAllStreams();
        return view('admin/admin-live-matches-edit', [
            'data'=>[
                'route'         => RouteServiceProvider::HOME,  
                'live_match'    => $liveMatch, 
                'streams'       => $streams
            ]
        ]);
    }
    
    public function inputLiveMatchesEdit(Request $request, $match_id)
    {
        if (!is_numeric($match_id) || $match_id < 0)
            die();
        $match_id = (int)$match_id;

        $input = $request->all();

        $fields = [
            'MStreamID' => isset($input['MStreamID']) ? $input['MStreamID'] : false,
        ];

        $inputsRules = [
            'MStreamID' => 'nullable|int',
        ];
        $validator = Validator::make($fields, $inputsRules
        );
        
        if ($validator->fails()) {
            return redirect(RouteServiceProvider::HOME.'/live_matches/edit/'.$match_id)
                        ->withErrors($validator)
                        ->withInput();
        }

        LiveMatches::updateLiveMatch($match_id, $fields);

        return redirect(RouteServiceProvider::HOME.'/live_matches/edit/'.$match_id)
        ->withInput();
    }

    public function liveMatchesClose($match_id)
    {
        if (!is_numeric($match_id) || $match_id < 0)
            die();
        $match_id = (int)$match_id;
        
        LiveMatches::closeLiveMatch($match_id);

        return redirect(RouteServiceProvider::HOME.'/live_matches')
        ->withInput();
    }

    public function liveMatchesDelete($match_id)
    {
        if (!is_numeric($match_id) || $match_id < 0)
            die();
        $match_id = (int)$match_id;
        LiveMatches::deleteLiveMatch($match_id);
        
        return redirect(RouteServiceProvider::HOME.'/live_matches')
        ->withInput();
    }

}
