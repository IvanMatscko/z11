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
use App\Input\Admin\PastMatches;
use Illuminate\Validation\Rule;

class AdminPastMatchesController extends Controller
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

    
    public function pastMatches()
    {
        $pastMatches = PastMatches::getMatchesPast([],false,'`d2mp`.`timestamp`');
        // var_dump($pastMatches);die;

        return view('admin/admin-past-matches', [
            'data'=>[
                'route' => RouteServiceProvider::HOME, 
                'pastMatches' => $pastMatches, 
            ]
        ]);
    }
    
    public function pastMatchesEdit($match_id)
    {
        if (!is_numeric($match_id) || $match_id < 0)
            die();
        $match_id = (int)$match_id;
        $pastMatch = PastMatches::getMatchesPast([],'`d2mp`.`match_id` = '.$match_id,'`d2mp`.`timestamp`',false,false);
        $pastMatch = $pastMatch ? $pastMatch[0] : false;
        if (!$pastMatch)
        {
            $validator = Validator::make(['match_id' => $match_id],['match_id' => 'nullable|int']);
            $validator->errors()->add('match_id', 'Not exists.');
            return redirect(RouteServiceProvider::HOME.'/past_matches')
                        ->withErrors($validator)
                        ->withInput();

        }
        // $streams = Stream::getAllStreams();
        return view('admin/admin-past-matches-edit', [
            'data'=>[
                'route'         => RouteServiceProvider::HOME,  
                'past_match'    => $pastMatch,
            ]
        ]);
    }
    
    public function inputPastMatchesEdit(Request $request, $match_id)
    {
        if (!is_numeric($match_id) || $match_id < 0)
            die();
        $match_id = (int)$match_id;

        $input = $request->all();

        $fields = [
            'winner' => isset($input['winner']) ? $input['winner'] : false,
        ];

        $inputsRules = [
            'winner' => Rule::in('null', 'radiant', 'dire'),
        ];
        $validator = Validator::make($fields, $inputsRules
        );
        
        if ($validator->fails()) {
            return redirect(RouteServiceProvider::HOME.'/past_matches/edit/'.$match_id)
                        ->withErrors($validator)
                        ->withInput();
        }

        $winner = [
            'null' => NULL, 'radiant' => 1, 'dire' => 0
        ];
        $fields['winner'] = $winner[$fields['winner']];
        PastMatches::updatePastMatch($match_id, $fields);
        PastMatches::recalculateSeriesResultsByPastMatch($match_id);

        return redirect(RouteServiceProvider::HOME.'/past_matches/edit/'.$match_id)
        ->withInput();
    }

    public function pastMatchesDelete($match_id)
    {
        if (!is_numeric($match_id) || $match_id < 0)
            die();
        $match_id = (int)$match_id;
        $match = PastMatches::getMatchesPast([],'`d2mp`.`match_id` = '.$match_id,false,1,false);
        PastMatches::deletePastMatch($match_id);
        if (!empty($match))
        {
            $linkedMatches = PastMatches::getMatchesPast([],'`d2mp`.`series_id` = '.$match[0]->series_id,false,1,false);
            
            if (!empty($linkedMatches))
                PastMatches::recalculateSeriesResultsByPastMatch($linkedMatches[0]->match_id);
        }
        return redirect(RouteServiceProvider::HOME.'/past_matches')
        ->withInput();
    }

}
