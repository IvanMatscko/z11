<?php


namespace App\Http\Controllers;
      
/*sockets*/
require_once env('BASE_DIR').'/include/socket/vendor/autoload.php';
use ElephantIO\Client;
use ElephantIO\Engine\SocketIO\Version2X;

/*laravel modules*/
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use App\Input\Admin\FutureMatches;
use App\Input\Admin\Leagues;
use App\Input\Admin\Teams;


class AdminFutureMatchesController extends Controller
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
    
    public function futureMatches()
    {
        $teams = Teams::getTeams(['team_name','team_id'], 'display = 1' , 'team_name');
        $leagues = Leagues::getLeagues(['name_EN','league_id'], false, 'name_EN');
        $futureMatches = FutureMatches::getMatchesFuture(['MFID','match_id','team_0', 'team_1', 'team_0_name', 'team_1_name', 'start_datetime', 'league_id','display'],false,'start_datetime');
        return view('admin/admin-future-matches', [
            'data'=>[
                'route' => RouteServiceProvider::HOME, 
                'futureMatches' => $futureMatches, 
                'teams' => $teams,
                'leagues' => $leagues,
            ]
        ]);
    }
    
    public function futureMatchesAdd()
    {
        $teams = Teams::getTeams(['team_name','team_id'], 'display = 1' , 'team_name');
        $leagues = Leagues::getLeagues(['name_EN','league_id'], false, 'name_EN');
        return view('admin/admin-future-matches-add', [
            'data'=>[
                'route' => RouteServiceProvider::HOME, 
                'teams' => $teams,
                'leagues' => $leagues,
            ]
        ]);
    }
    
    public function inputFutureMatchesAdd(Request $request)
    {
        $input = $request->all();
        $inputsRules = [
            'match_id' => 'nullable|int',
            'team_0' => ['required','regex:'.FutureMatches::$inputRegEx['team']],
            'team_1' => ['required','regex:'.FutureMatches::$inputRegEx['team']],
            'date' => ['required','regex:'.FutureMatches::$inputRegEx['date']],
            'time' => ['required','regex:'.FutureMatches::$inputRegEx['time']],
            'league' => ['required','regex:'.FutureMatches::$inputRegEx['league']],
        ];
        $validator = Validator::make($input, $inputsRules//, $messages
        );
        if ($validator->fails()) {
            return redirect(RouteServiceProvider::HOME.'/future_matches/add')
                        ->withErrors($validator)
                        ->withInput();
        } else
        {
            $fields['match_id'] = isset($input['match_id']) ? $input['match_id'] : NULL;
            $fields['team_0'] = FutureMatches::getTeam($input['team_0']);
            $fields['team_1'] = FutureMatches::getTeam($input['team_1']);
            $fields['league_id'] = FutureMatches::getLeague($input['league']);
            $fields['start_datetime'] = strtotime($input['date'].' '.$input['time'].':00');
            $fields['timestamp'] = strtotime('now');
            $fields['display'] = 1;
            FutureMatches::addMatchFuture($fields);
        }

        return redirect(RouteServiceProvider::HOME.'/future_matches')
        ->withInput();
    }
    
    public function inputFutureMatches(Request $request)
    {
        $input = $request->all();

//        $DBData = Common::getMatchesFuture(['MFID','match_id','team_0', 'team_1', 'start_datetime', 'league_id','display'],false,'start_datetime');

        foreach ($input['futureMatch'] as $MFID => $inputMatch)
        {
            $fields = [];
            if (isset($inputMatch['match_id']) && $inputMatch['match_id'])
                $fields['match_id'] =  $inputMatch['match_id'];
            $fields['team_0'] = FutureMatches::getTeam($inputMatch['team_0']);
            $fields['team_1'] = FutureMatches::getTeam($inputMatch['team_1']);
            $fields['league_id'] = FutureMatches::getLeague($inputMatch['league_id']);
            $fields['start_datetime'] = $inputMatch['start_datetime'];
//            $fields['timestamp'] = strtotime('now');
            $fields['display'] = isset($inputMatch['display']) ? 1 : 0;
            if (FutureMatches::compareFutureMatchInputs($MFID,$fields))
            {
                FutureMatches::updateFutureMatch($MFID,$fields);
            }
        }

        $options = [
            //if SSL is not valid
            'context' => [
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false
                ]
            ]
        ];
        $version = new Version2X('https://127.0.0.1:3000', $options);
        $client = new Client($version);
        $client->initialize();
        $futureMatches = FutureMatches::getMatchesFuture([],false,false,5);
        //convert result to array
        $futureMatches = collect($futureMatches)->map(function($x){ return (array) $x; })->toArray();
        $client->emit('matches_future', ['block'=>'matches_future', 'data'=>$futureMatches]);
        $client->close();

        return redirect(RouteServiceProvider::HOME.'/future_matches')
        ->withInput();
    }
    
    public function delFutureMatch($MFID)
    {
        if (!is_numeric($MFID) || $MFID < 0)
            die();
        $MFID = (int)$MFID;
        FutureMatches::delMatchFuture($MFID);

        return redirect(RouteServiceProvider::HOME.'/future_matches')
        ->withInput();
    }

}
