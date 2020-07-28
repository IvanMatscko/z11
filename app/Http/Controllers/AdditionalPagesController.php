<?php

namespace App\Http\Controllers;

// use App\MatchFuture;
use App;
use App\Team;
use App\Player;
use App\League;
use App\Trainer;
use App\MatchPast;
use Carbon\Carbon;
use App\Custom\Common;
use Illuminate\Http\Request;
use App\Input\Admin\PastMatches;
use App\Input\Admin\FutureMatches;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class AdditionalPagesController extends Controller
{

    /**
     * Show future matches in page
     *
     * @param $lang
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function schedule($lang)
    {
        $language_block = Common::prepareLanguageBlock();
        $search_block   = Common::prepareSearchBlock();

        $today             = Carbon::today()->timestamp;
        $last_day_of_month = Carbon::parse(Carbon::now()->endOfMonth()->addDay(1)->format('Y-m-d 00:00:00'))->timestamp;

        // $matches_future = MatchFuture::where('start_datetime', '>=', $today)->where('start_datetime', '<', $last_day_of_month)->orderBy('start_datetime', 'ASC')->whereDisplay(1)->get();

        $matches_future = FutureMatches::getMatchesFuture([],
        '`start_datetime` >= '.$today.' AND `start_datetime` < '.$last_day_of_month.' AND `display` = 1','`start_datetime`');

        $future_matches = [];
        foreach ($matches_future as $match) {
            $future_matches[Carbon::parse($match->start_datetime)->format('d.m.Y')][] = $match;
        }

        return view('schedule', [
            'data'           => [
                'lang' => $lang,
            ],
            'language_block' => $language_block,
            'search_block'   => $search_block,
            'future_matches' => $future_matches
        ]);
    }

    /**
     * Show all past matches in page
     *
     * @param $lang
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function results($lang)
    {
        $language_block = Common::prepareLanguageBlock();
        $search_block   = Common::prepareSearchBlock();

        $first_day_of_month = Carbon::now()->subMonth()->timestamp;
        $tomorrow           = Carbon::tomorrow()->timestamp;

        // $past_matches = MatchPast::where('timestamp', '>=', $first_day_of_month)
        //                         ->where('timestamp', '<', $tomorrow)
        //                         ->whereNotNull('winner')
        //                         ->orderByDesc('timestamp')->get();

        $past_matches   = PastMatches::getMatchesPast(['`d2mp`.`league_id`','`d2mp`.`series_id`'],'`d2mp`.`winner` IS NOT NULL','`d2mp`.`timestamp`',1000,true);

        $past_matches_of_month = [];
        foreach ($past_matches as $match) {
            // $dire_win_maps    = explode(',', $match->dire_win_maps);
            // $radiant_win_maps = explode(',', $match->radiant_win_maps);

            // if (
            //     (count($dire_win_maps) > 1 && $match->dire_win_in_series != 1) OR
            //     (count($radiant_win_maps) > 1 && $match->radiant_win_in_series != 1) OR
            //     ($match->number_in_series) == 1 &&
            //     (count($dire_win_maps) == 1 OR count($radiant_win_maps) == 1)) {
                $past_matches_of_month[Carbon::parse($match->lm_timestamp)->format('d.m.Y')][] = $match;
            // }
        }

        return view('results', [
            'data'                  => [
                'lang' => $lang,
            ],
            'language_block'        => $language_block,
            'search_block'          => $search_block,
            'past_matches_of_month' => $past_matches_of_month,
        ]);
    }

    public function tournament($lang, $tournament_id = null)
    {
        $language_block = Common::prepareLanguageBlock();
        $search_block   = Common::prepareSearchBlock();

        $allLeagues = League::whereNotNull('LStatus')->get()->sortByDesc('LID');

        if (is_null($tournament_id) OR !isset($tournament_id))
        {
            $firstLiveLeague = $allLeagues->firstWhere('LStatus', '=', 1);
            if ($firstLiveLeague)
            {
                $tournament_id = $firstLiveLeague->LID;
            } else if (isset($allLeagues[0]))
            {
                $tournament_id = $allLeagues[0]->LID;
            } else
            {
                abort(404);
            }
        }

        $leagueForLID = DB::select(League::getLeaguesTeamsDataSql(), [$tournament_id]);

        if (!$leagueForLID)
        {
            abort(404);
        }


        $teams = $all_leagues = []; //<---
        foreach ($leagueForLID as $k => $league) {
            $teams[] = $league->team_id;
            $teamData = DB::connection('z11_dota2_history')->table('z11_dota2_teams')->whereIn('team_id', $teams)->select('*')->get();
        }
         $teams_id = implode(',',$teams);




        $team_matches = PastMatches::getMatchesPast(
            [],
            '`d2mp`.`winner` IS NOT NULL AND 
            `d2mp`.`team_0` IN (' . $teams_id . ') OR `d2mp`.`team_1` IN (' . $teams_id .')',
            '`d2mp`.`timestamp`',
            false,
            true
        );

        $total_matches         = count($team_matches);
        $count_all_won_matches = 0;
        $total = $wins = $winrates = [];

        foreach ($teams as $k => $team_id){
            $total[$team_id] = 0;
            $wins[$team_id] = 0;

            foreach ($team_matches as $match){
                //matches
//                if (($match->team_0 == $team_id) || ($match->team_1 == $team_id)){
//                    $total[$team_id] += 1;
//                    if ((($match->team_0 == $team_id) && $match->winner == 1) ||
//                        (($match->team_1 == $team_id) && $match->winner == 0)
//                    )
//                    {
//                        $wins[$team_id] += 1;
//                    }
//                }
                //series
                if (($match->lm_team_0 == $team_id) || ($match->lm_team_1 == $team_id)){
                    $total[$team_id] += 1;
                    if ((($match->lm_team_0 == $team_id) && $match->lm_winner == 1) ||
                        (($match->lm_team_1 == $team_id) && $match->lm_winner == 0)
                    )
                    {
                        $wins[$team_id] += 1;
                    }

                }
            }
            if ($total[$team_id] == 0 && $wins[$team_id] == 0){
                $winrates[$team_id] = 0;
            }else{
                $winrates[$team_id] = $wins[$team_id] / $total[$team_id] * 100;
            }

        }

        foreach ($allLeagues as $k => $league) {
            $all_leagues[$league->LStatus][] = $league;
        }

        return view('tournament', [
            'data'           => $tournament_id,
            'language_block' => $language_block,
            'search_block'   => $search_block,
            'league'         => $leagueForLID[0] ?? null,
            'teams'          => $teams,
            'all_leagues'    => $all_leagues,
            'teamData'    => $teamData,
            'percent_winrate' => $total,
        ]);
    }

    public function league($lang, $league_id = null)
    {
        $tournament = DB::connection('z11_dota2_history')->table('z11_dota2_leagues')->where('league_id', $league_id)->select('*')->orderBy('start_time', 'desc')->get();

        if (!isset($tournament[0]) || empty($tournament[0]))
        {
            return view('exception', [
                'language_block' => Common::prepareLanguageBlock(),
                'search_block'   => Common::prepareSearchBlock(),
                'exception_code'    => '404',
                'exception_message'    => Lang::get('l.exception_404'),
            ]);
        }
        return redirect(App::getLocale().'/tournament/'.$tournament[0]->LID);
    }

    public function emptySearch($lang)
    {
        return view('exception', [
            'language_block' => Common::prepareLanguageBlock(),
            'search_block'   => Common::prepareSearchBlock(),
            'exception_code'    => '404',
            'exception_message'    => Lang::get('l.exception_404'),
        ]);
    }

    public function search($lang, Request $request)
    {
        $input = $request->all();

        preg_match('/^[a-z0-9 _\-\.]{2,255}$/i',$input['search_z11'],$match);

        if (!isset($match[0]) || empty($match[0]))
        {
            return view('exception', [
                'language_block' => Common::prepareLanguageBlock(),
                'search_block'   => Common::prepareSearchBlock(),
                'exception_code'    => '404',
                'exception_message'    => Lang::get('l.exception_404'),
            ]);
        }

        $options = [];
        preg_match('/^([a-z0-9 _\-\.]{2,255}) - (Team|Player)$/i',$input['search_z11'],$matches);

        if (!isset($matches) || !is_array($matches) || count($matches) !== 3)
        {
            $search = $match[0];
        } else
        {
            $search = $matches[1];
            if ($matches[2] === 'Team')
                $options['teams_only'] = true;
            if ($matches[2] === 'Player')
                $options['players_only'] = true;
        }

        $res = Common::searchInHistoryByName($search, $options);

        if (empty($res))
            return view('exception', [
                'language_block' => Common::prepareLanguageBlock(),
                'search_block'   => Common::prepareSearchBlock(),
                'exception_code'    => '404',
                'exception_message'    => Lang::get('l.exception_404'),
            ]);
        return redirect(App::getLocale().'/'.$res[0]->type.'/'.$res[0]->id)
        ->withInput();
    }
}
