<?php

namespace App\Http\Controllers;

use App\Custom\Common;
use App\Input\Admin\PastMatches;
use App\Player;
use App\Team;
use App\Trainer;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index(Request $request)
    {
        if ( isset($request->page) && !is_numeric($request->page))
            abort(404);

        $language_block = Common::prepareLanguageBlock();
        $search_block   = Common::prepareSearchBlock();
        $teams         = Team::with('players')->orderByDesc('team_id')->get();

        foreach ($teams as $team)
        {
            $count_all_won_matches = 0;
            $team_matches = PastMatches::getMatchesPast(
                [],
                '`d2mp`.`winner` IS NOT NULL AND 
            `d2mp`.`team_0` = ' . intval($team->team_id) . ' OR `d2mp`.`team_1` = ' . intval($team->team_id),
                '`d2mp`.`timestamp`',
                false,
                true
            );
            $total_matches         = count($team_matches);

            foreach ($team_matches as $key => $match) {
                for ($i = 0; $i < 10; $i++) {

                    $matches[$key]['team_0'] = $team->team_id;
                    $matches[$key]['team_1'] = $match->team_1 == $team->team_id ? $match->team_0 : $match->team_1;

                    $matches[$key]['team_0_name'] = $team->team_id == $match->team_0 ? $match->team_0_name : $match->team_1_name;
                    $matches[$key]['team_1_name'] = $team->team_id == $match->team_1 ? $match->team_0_name : $match->team_1_name;

                    $matches[$key]['radiant_win_in_series'] = $team->team_id == $match->team_0 ? $match->radiant_win_in_series : $match->dire_win_in_series;
                    $matches[$key]['dire_win_in_series']    = $team->team_id == $match->team_1 ? $match->radiant_win_in_series : $match->dire_win_in_series;


                    if ($match->team_0 == $team->team_id && $match->winner == 1) {
                        $winner = true;
                    } elseif ($match->team_1 == $team->team_id && $match->winner == 0) {
                        $winner = true;
                    } else {
                        $winner = false;
                    }

                    $matches[$key]['winner']     = $winner;
                    $matches[$key]['match_id']   = $match->match_id;
                    $matches[$key]['league_id']  = $match->league_id;
                    $matches[$key]['match_day']  = Carbon::parse($match->timestamp)->format("d.m");
                    $matches[$key]['match_hour'] = Carbon::parse($match->timestamp)->format("H:i");

                    if (isset($match->{$i . '_accountid'})) {
                        $matches_players[$key][$match->{$i . '_accountid'}] =
                            [
                                'heroid'        => $match->{$i . '_heroid'},
                                'kill_count'    => $match->{$i . '_kill_count'},
                                'death_count'   => $match->{$i . '_death_count'},
                                'assists_count' => $match->{$i . '_assists_count'},
                            ];
                    }
                }

                if ($winner) {
                    $count_all_won_matches = ++$count_all_won_matches;
                }
            }

            $team->winrate = 0;
            if ($count_all_won_matches > 0 && $total_matches > 0)
                $team->winrate =  round(($count_all_won_matches / $total_matches) * 100) ?? 0;

        }

        $teamsPaginated = $teams->sortByDesc('winrate')->forPage(round($request->page, 0) ?? 1, 18);

        if ($teamsPaginated->count() < 1)
            abort(404);

        return view('pages.team.index', [
            'language_block'  => $language_block,
            'search_block'    => $search_block,
            'teams' => $teamsPaginated,
            'page' => $request->page
        ]);
    }

    public function show($lang, $team_id)
    {
        $language_block = Common::prepareLanguageBlock();
        $search_block   = Common::prepareSearchBlock();

        //$team_matches = MatchPast::where('team_0', $team_id)->orWhere('team_1', $team_id)->whereNotNull('winner')->groupBy('series_id')->orderByDesc('timestamp')->get();
        $team_matches = PastMatches::getMatchesPast(
            [],
            '`d2mp`.`winner` IS NOT NULL AND 
            `d2mp`.`team_0` = ' . intval($team_id) . ' OR `d2mp`.`team_1` = ' . intval($team_id),
            '`d2mp`.`timestamp`',
            false,
            true
        );

        $team         = Team::findOrFail($team_id);
        $team_players = Player::whereTeamId($team_id)->orderBy('position')->get();
        $trainer      = Trainer::whereTeamId($team_id)->get('trainer_id');

        $players               = $matches = $matches_players = [];
        $total_matches         = count($team_matches);
        $winner                = false;
        $count_all_won_matches = 0;

        foreach ($team_matches as $key => $match) {
            for ($i = 0; $i < 10; $i++) {

                $matches[$key]['team_0'] = $team_id;
                $matches[$key]['team_1'] = $match->team_1 == $team_id ? $match->team_0 : $match->team_1;

                $matches[$key]['team_0_name'] = $team_id == $match->team_0 ? $match->team_0_name : $match->team_1_name;
                $matches[$key]['team_1_name'] = $team_id == $match->team_1 ? $match->team_0_name : $match->team_1_name;

                $matches[$key]['radiant_win_in_series'] = $team_id == $match->team_0 ? $match->radiant_win_in_series : $match->dire_win_in_series;
                $matches[$key]['dire_win_in_series']    = $team_id == $match->team_1 ? $match->radiant_win_in_series : $match->dire_win_in_series;


                if ($match->team_0 == $team_id && $match->winner == 1) {
                    $winner = true;
                } elseif ($match->team_1 == $team_id && $match->winner == 0) {
                    $winner = true;
                } else {
                    $winner = false;
                }

                $matches[$key]['winner']     = $winner;
                $matches[$key]['match_id']   = $match->match_id;
                $matches[$key]['league_id']  = $match->league_id;
                $matches[$key]['match_day']  = Carbon::parse($match->timestamp)->format("d.m");
                $matches[$key]['match_hour'] = Carbon::parse($match->timestamp)->format("H:i");

                if (isset($match->{$i . '_accountid'})) {
                    $matches_players[$key][$match->{$i . '_accountid'}] =
                        [
                            'heroid'        => $match->{$i . '_heroid'},
                            'kill_count'    => $match->{$i . '_kill_count'},
                            'death_count'   => $match->{$i . '_death_count'},
                            'assists_count' => $match->{$i . '_assists_count'},
                        ];
                }
            }

            if ($winner) {
                $count_all_won_matches = ++$count_all_won_matches;
            }
        }

        foreach ($team_players as $player) {
            $players[$player->account_id]['accountid'] = $player->account_id;
            $players[$player->account_id]['name']      = $player->name;
            $players[$player->account_id]['position']  = $player->position;
        }

        foreach ($matches_players as $key => $player) {
            foreach ($players as $k => $p) {
                if (isset($player[$k])) {
                    $players[$k]['hero_ids'][] = $player[$k];
                } /*else {
                    $players[$k]['heroes'] = [];
                }*/
            }
        }

        $how_popular_heroes_in_player = [];
        foreach ($players as $key => $p) {
            if (isset($p['hero_ids'])) {
                $collection = collect($p['hero_ids']);
                if ($collection->isNotEmpty()) {
                    $how_popular_heroes_in_player[$key] = array_count_values($collection->pluck('heroid')->toArray());
                }
            }
            unset($p['heroes']);
        }

        //sort by popularity hero
        foreach ($how_popular_heroes_in_player as $k => $v) {
            ksort($how_popular_heroes_in_player[$k], SORT_NUMERIC);
        }

        foreach ($how_popular_heroes_in_player as $k => $heroes_player) {
            $players[$k]['hero_ids'] = array_slice(array_keys($heroes_player), 0, 3);
        }

        return view('pages.team.show', [
            'team'            => $team,
            'language_block'  => $language_block,
            'search_block'    => $search_block,
            'percent_winrate' => round(($count_all_won_matches / $total_matches) * 100) ?? 0,
            'team_matches'    => collect($matches)->slice(0, 6),
            'team_players'    => $players,
            'team_trainer'    => $trainer[0] ?? null,
        ]);
    }
}
