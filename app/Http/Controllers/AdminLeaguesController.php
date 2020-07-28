<?php


namespace App\Http\Controllers;

// /*sockets*/
// require_once env('BASE_DIR').'/include/socket/vendor/autoload.php';
// use ElephantIO\Client;
// use ElephantIO\Engine\SocketIO\Version2X;

/*laravel modules*/
use App\Team;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Input\Admin\Leagues;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use App\Stream;

class AdminLeaguesController extends Controller
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


    public function leagues()
    {
        $leagues = Leagues::getLeagues([],false,'league_id');
        $streams = Stream::getAllStreams();
        $arr_streams = [];
        if (!empty($streams))
        {
            foreach ($streams as $stream)
            {
                $arr_streams[$stream->id] = $stream;
            }
        }

        return view('admin/admin-leagues', [
            'data'=>[
                'route' => RouteServiceProvider::HOME,
                'streams' => $arr_streams,
                'leagues' => $leagues,
            ]
        ]);
    }

    public function leaguesAdd()
    {
        $teams = Team::all('team_id', 'team_name');
        $streams = Stream::getAllStreams();
        return view('admin/leagues/add', [
            'data'  => [
                'route'     => RouteServiceProvider::HOME,
                'streams'   => $streams,
                'BO'        => Leagues::$BO,
            ],
            'teams' => $teams,
        ]);
    }

    public function inputLeaguesAdd(Request $request)
    {
        $input = $request->all();

        $inputsRules = [
            'league_id'         => 'nullable|int',
            'name_EN'           => 'nullable',
            'tournament_url'    => 'nullable',
            'league_logo'       => 'mimes:png',
            'teams'             => 'sometimes|array|min:1|max:18',
            'teams.*'           => "sometimes|numeric",
            'start_time'        => 'date',
            'end_time'          => 'date',
            'status'            => [
                'sometimes',
                Rule::in(0, 1, 2),
            ],
            'stream_id'         => 'nullable|int',
            'BO'                => 'nullable|int',
            'number'            => 'nullable|int',
        ];
        $validator   = Validator::make($input, $inputsRules);

        $res = false;
        if ($validator->fails()) {
            return redirect()->route('leagues.add')
                ->withErrors($validator)
                ->withInput();
        } else {
            if (isset($input['league_id']) && $input['league_id'] && Leagues::getLeagues([], '`league_id` = ' . $input['league_id'], false, 1)) {
                $validator->errors()->add('league_id', 'Already exists.');

                return redirect()->route('leagues.add')
                    ->withErrors($validator)
                    ->withInput();
            }
            if (!$request->hasFile('league_logo') && !$input['league_id']) {
                $validator->errors()->add('league_logo', 'To upload Logo you must determine League ID.');

                return redirect()->route('leagues.add')
                    ->withErrors($validator)
                    ->withInput();
            }
            if (!isset($input['teams']) OR empty($input['teams'])) {
                $validator->errors()->add('league_teams', 'Please select at least one team');

                return redirect()->route('leagues.add')
                    ->withErrors($validator)
                    ->withInput();
            }


            $fields['league_id']        = $input['league_id'];
            $fields['name_EN']          = $input['name_EN'];
            $fields['tournament_url']   = $input['tournament_url'];
            $fields['start_time']       = Carbon::parse($input['start_time'])->timestamp;
            $fields['end_time']         = Carbon::parse($input['end_time'])->timestamp;
            $fields['LStatus']          = $input['status'];
            $fields['stream_id']        = $input['stream_id'];
            $fields['BO']               = $input['BO'];
            $fields['number']           = $input['number'];
            $LID = Leagues::addLeague($fields);

            $leagues_to_teams = [];
            foreach ($input['teams'] as $team) {
                $leagues_to_teams[] = [
                    'LID'     => $LID,
                    'team_id' => intval($team),
                ];
            }

            $res = Leagues::addLeaguesToTeams($leagues_to_teams);

            if ($request->hasFile('league_logo')) {
                /*$path = Storage::putFile('logos', $request->file('league_logo'));
                @rename(env('BASE_DIR') . '/z11/storage/app/' . $path, env('BASE_DIR') . '/z11/public/img/league/' . $fields['league_id'] . '.png');*/
                $logo_file = $request->file('league_logo');
                $logo_name = $input['league_id'] . '.' . $logo_file->getClientOriginalExtension();
                $logo_file->move(public_path() . '/img/league/', $logo_name);
            }
        }

        if ($res) {

            return redirect(RouteServiceProvider::HOME . '/leagues')
                ->withInput();
        }

        return redirect(RouteServiceProvider::HOME . '/leagues/add')
            ->withInput();
    }

    public function delLeague($LID)
    {
        if (!is_numeric($LID) || $LID < 0) {
            die();
        }
        $LID = (int) $LID;
        Leagues::delLeague($LID);

        return redirect(RouteServiceProvider::HOME . '/leagues')->withInput();
    }

    public function leaguesEdit($LID)
    {
        if (!is_numeric($LID) || $LID < 0) {
            die();
        }

        $leagues        = Leagues::getLeagues([], '`LID`=' . intval($LID), 'league_id');
        $leaguesToTeams = Leagues::getLeaguesTeams([], '`LID`=' . intval($LID));
        $streams = Stream::getAllStreams();

        if (empty($leagues)) {
            return redirect(RouteServiceProvider::HOME . '/leagues')->withInput();
        }

        $leagues_to_team_keys = [];
        foreach ($leaguesToTeams as $k => $leagues_to_team) {
            $leagues_to_team_keys[] = $leagues_to_team->team_id;
        }

        $teams = Team::all('team_id', 'team_name');

        return view('admin/leagues/edit', [
            'data'  => [
                'route'                 => RouteServiceProvider::HOME,
                'league'                => $leagues[0],
                'leagues_to_team_keys'  => $leagues_to_team_keys,
                'streams'               => $streams,
                'BO'                    => Leagues::$BO,
            ],
            'teams' => $teams,
        ]);
    }

    public function inputLeaguesEdit(Request $request, $LID)
    {
        if (!is_numeric($LID) || $LID < 0) {
            die();
        }
        $LID   = (int) $LID;
        $input = $request->all();

        $inputsRules = [
            'league_id'         => 'nullable|int',
            'name_EN'           => 'nullable',
            'tournament_url'    => 'nullable',
            'league_logo'       => 'mimes:png',
            'teams'             => 'sometimes|array|min:1|max:18',
            'teams.*'           => "sometimes|numeric",
            'start_time'        => 'date',
            'end_time'          => 'date',
            'status'            => [
                'sometimes',
                Rule::in(0, 1, 2),
            ],
            'stream_id'         => 'nullable|int',
            'BO'                => 'nullable|int',
            'number'            => 'nullable|int',
        ];
        $validator   = Validator::make($input, $inputsRules);
        $res         = false;
        if ($validator->fails()) {
            return redirect(RouteServiceProvider::HOME . '/leagues/edit/' . $LID)
                ->withErrors($validator)
                ->withInput();
        } else {
            if (!is_null($request->file('league_logo')) && !$input['league_id']) {
                $validator->errors()->add('league_logo', 'To upload Logo you must determine League ID.');

                return redirect(RouteServiceProvider::HOME . '/leagues/edit/' . $LID)
                    ->withErrors($validator)
                    ->withInput();
            }

            if (!isset($input['teams']) OR empty($input['teams'])) {
                $validator->errors()->add('league_teams', 'Please select at least one team');

                return redirect()->route('leagues.add')
                    ->withErrors($validator)
                    ->withInput();
            }

            $leagues_to_teams = [];
            foreach ($input['teams'] as $team) {
                $leagues_to_teams[] = [
                    'team_id' => intval($team),
                    'LID'     => $LID,
                ];
            }

            $fields['league_id']        = $input['league_id'];
            $fields['name_EN']          = $input['name_EN'];
            $fields['tournament_url']   = $input['tournament_url'];
            $fields['start_time']       = Carbon::parse($input['start_time'])->timestamp;
            $fields['end_time']         = Carbon::parse($input['end_time'])->timestamp;
            $fields['LStatus']          = $input['status'];
            $fields['stream_id']        = $input['stream_id'];
            $fields['BO']               = $input['BO'];
            $fields['number']           = $input['number'];

            $res = Leagues::updateLeague($LID, $fields);
            Leagues::updateLeaguesToTeams($leagues_to_teams, $LID);

            if ($request->hasFile('league_logo')) {

                if (File::exists(public_path('/img/league/' . $input['league_id'] . '.png'))) {
                    File::delete(public_path('/img/league/' . $input['league_id'] . '.png'));
                }

                $logo_file = $request->file('league_logo');
                $logo_name = $input['league_id'] . '.' . $logo_file->getClientOriginalExtension();
                $logo_file->move(public_path() . '/img/league/', $logo_name);
            }
        }

        if ($res) {
            return redirect()
                ->route('leagues.index')
                ->withInput();
        }

        return redirect()
            ->route('leagues.edit', $LID)
            ->withInput();

    }
}
