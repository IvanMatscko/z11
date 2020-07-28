<?php


namespace App\Http\Controllers;
      
// /*sockets*/
// require_once env('BASE_DIR').'/include/socket/vendor/autoload.php';
// use ElephantIO\Client;
// use ElephantIO\Engine\SocketIO\Version2X;

/*laravel modules*/
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use App\Input\Admin\Countries;
use App\Input\Admin\Teams;
use Illuminate\Support\Facades\Storage;

class AdminTeamsController extends Controller
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
    
    public function teams()
    {
        $teams = Teams::getTeams([],false,'team_id');
        return view('admin/admin-teams', [
            'data'=>[
                'route' => RouteServiceProvider::HOME, 
                'teams' => $teams, 
            ]
        ]);
    }
    
    public function inputTeams(Request $request)
    {
        $input = $request->all();

        foreach ($input['team'] as $team_id => $inputTeam)
        {
            $fields = [];
            if (!isset($team_id) || !$team_id)
                continue;

            $fields['display'] = isset($inputTeam['display']) ? 1 : 0;

            if (Teams::compareTeamInputs($team_id,$fields))
            {
                Teams::updateTeam($team_id,$fields);
            }
        }

        return redirect(RouteServiceProvider::HOME.'/teams')
        ->withInput();
    }
    
    public function teamsAdd()
    {
        return view('admin/admin-teams-add', [
            'data'=>[
                'route' => RouteServiceProvider::HOME,
            ]
        ]);
    }
    
    public function inputTeamsAdd(Request $request)
    {
        $input = $request->all();

        $inputsRules = [
            'team_id' => ['required','int'],
        ];
        $validator = Validator::make($input, $inputsRules//, $messages
        );
        $res = false;
        if ($validator->fails()) {
            return redirect(RouteServiceProvider::HOME.'/teams/add')
                        ->withErrors($validator)
                        ->withInput();
        } else
        {
            if (Teams::getTeams([],'`team_id` = '.$input['team_id'], false, 1))
            {
                $validator->errors()->add('team_id', 'Already exists.');
                return redirect(RouteServiceProvider::HOME.'/teams/add')
                            ->withErrors($validator)
                            ->withInput();
            }
            $fields['team_id'] = $input['team_id'];
            $res = Teams::addTeam($fields);
        }

        if ($res)
        {
            return redirect(RouteServiceProvider::HOME.'/teams/edit/'.$input['team_id'])
            ->withInput();
        }
        return redirect(RouteServiceProvider::HOME.'/teams/add')
        ->withInput();
    }

    public function teamsEditBlank()
    {
        return view('admin/admin-teams-edit-blank', [
            'data'=>[
                'route' => RouteServiceProvider::HOME, 
            ]
        ]);
    }

    public function inputTeamsEditBlank(Request $request)
    {
        $input = $request->all();

        $inputsRules = [
            'team_id' => ['required','int'],
        ];
        $validator = Validator::make($input, $inputsRules//, $messages
        );

        if ($validator->fails()) {
            return redirect(RouteServiceProvider::HOME.'/teams/edit')
                        ->withErrors($validator)
                        ->withInput();
        } else
        {
            if (!Teams::getTeams([],'`team_id` = '.$input['team_id'], false, 1))
            {
                $validator->errors()->add('team_id', 'not exists.');
                return redirect(RouteServiceProvider::HOME.'/teams/edit')
                            ->withErrors($validator)
                            ->withInput();
            }
        }

        return redirect(RouteServiceProvider::HOME.'/teams/edit/'.$input['team_id'])
        ->withInput();
    }

    public function teamsEdit($team_id)
    {
        if (!is_numeric($team_id) || $team_id < 0)
            die();
        $team_id = (int)$team_id;

        $countries = Countries::getCountries(['country_tag','country_name'], false , 'country_name');
        $team = Teams::getTeams([],'`team_id` = '.$team_id);
        return view('admin/admin-teams-edit', [
            'data'=>[
                'route' => RouteServiceProvider::HOME, 
                'countries' => $countries,
                'team_id' => $team_id,
                'team' => $team[0]
            ]
        ]);
    }

    public function inputTeamsEdit(Request $request, $team_id)
    {
        if (!is_numeric($team_id) || $team_id < 0)
            die();
        $team_id = (int)$team_id;
        $input = $request->all();

        $inputsRules = [
            'team_id' => ['required','int'],
            'team_name' => 'nullable',
            'country_code' => 'nullable',
            'team_logo' => 'mimes:png',
            'player_0_account_id' => 'nullable|int',
            'player_1_account_id' => 'nullable|int',
            'player_2_account_id' => 'nullable|int',
            'player_3_account_id' => 'nullable|int',
            'player_4_account_id' => 'nullable|int',
            'player_5_account_id' => 'nullable|int',
            'display' => ['nullable'],
        ];
        $validator = Validator::make($input, $inputsRules//, $messages
        );
        
        if ($validator->fails()) {
            return redirect(RouteServiceProvider::HOME.'/teams/edit/'.$team_id)
                        ->withErrors($validator)
                        ->withInput();
        } else
        {
            if (!Teams::getTeams([],'`team_id` = '.$input['team_id'], false, 1))
            {
                $validator->errors()->add('team_id', 'not exists.');
                return redirect(RouteServiceProvider::HOME.'/teams/edit'.$team_id)
                            ->withErrors($validator)
                            ->withInput();
            }
        }
        
        if (!is_null($request->file('team_logo')))
        {
            $path = Storage::putFile('logos', $request->file('team_logo'));
            rename(env('BASE_DIR').'/z11/storage/app/'.$path, env('BASE_DIR').'/z11/public/img/team/'.$team_id.'.png');
        }


        return redirect(RouteServiceProvider::HOME.'/teams/edit/'.$team_id)
        ->withInput();
    }

}
