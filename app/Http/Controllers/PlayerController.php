<?php

namespace App\Http\Controllers;

use App\Custom\Common;
use App\MatchPast;
use App\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlayerController extends Controller
{
    public function index()
    {
        $language_block = Common::prepareLanguageBlock();
        $search_block   = Common::prepareSearchBlock();

        $players = Player::with('team')->paginate(18);

        foreach ($players as $player) {
            $display_matches_count = 6;
            $display_heroes_count = 3;

            $matches = DB::select(MatchPast::matchesDataSql(), [$player->account_id]);

            $player_hero_in_match = $heroes = $hero_games = [];

            foreach ($matches as $key => $match) {
                for ($i = 0; $i < 10; $i++) {
                    if ($match->{$i . '_accountid'} == $player->account_id) {
                        if ($key < $display_matches_count) {
                            $player_hero_in_match[$key] = [
                                'heroid' => $match->{$i . '_heroid'},
                                'kill_count' => $match->{$i . '_kill_count'},
                                'death_count' => $match->{$i . '_death_count'},
                                'assists_count' => $match->{$i . '_assists_count'},
                            ];
                        }
                        if (!isset($heroes[$match->{$i . '_heroid'}])) {
                            $heroes[$match->{$i . '_heroid'}] = 1;
                            $hero_games[$match->{$i . '_heroid'}] = [
                                'total' => 1,
                                'won' => (($i < 5 && $match->winner == 1) || ($i > 4 && $match->winner == 0)),
                                'kill' => $match->{$i . '_kill_count'},
                                'death' => $match->{$i . '_death_count'},
                                'assists' => $match->{$i . '_assists_count'},
                            ];
                        } else {
                            $heroes[$match->{$i . '_heroid'}] += 1;
                            $hero_games[$match->{$i . '_heroid'}]['total'] += 1;
                            $hero_games[$match->{$i . '_heroid'}]['won'] += (($i < 5 && $match->winner == 1) || ($i > 4 && $match->winner == 0)) ? 1 : 0;
                            $hero_games[$match->{$i . '_heroid'}]['kill'] += $match->{$i . '_kill_count'};
                            $hero_games[$match->{$i . '_heroid'}]['death'] += $match->{$i . '_death_count'};
                            $hero_games[$match->{$i . '_heroid'}]['assists'] += $match->{$i . '_assists_count'};
                        }
                    }
                }
            }

            asort($heroes, SORT_NUMERIC);
            $heroes = array_reverse(array_slice($heroes, $display_heroes_count * -1, NULL, true), true);

            $player->heroes = $heroes;
        }
//        dd($players);

        return view('pages.player.index', [
            'language_block'  => $language_block,
            'search_block'    => $search_block,
            'players' => $players,
        ]);
    }


    public function show($lang, $player_id)
    {
        $language_block = Common::prepareLanguageBlock();
        $search_block   = Common::prepareSearchBlock();

        $display_matches_count = 6;
        $display_heroes_count = 3;

        $player = DB::select(MatchPast::playerDataSql(), [$player_id]);

        abort_if(collect($player)->count() === 0, 404);

        $matches = DB::select(MatchPast::matchesDataSql(), [$player_id]);

        $player_hero_in_match = $heroes = $hero_games = [];

        foreach ($matches as $key => $match)
        {
            for ($i = 0; $i < 10; $i++)
            {
                if ($match->{$i . '_accountid'} == $player_id)
                {
                    if ($key < $display_matches_count)
                    {
                        $player_hero_in_match[$key] = [
                            'heroid'        => $match->{$i . '_heroid'},
                            'kill_count'    => $match->{$i . '_kill_count'},
                            'death_count'   => $match->{$i . '_death_count'},
                            'assists_count' => $match->{$i . '_assists_count'},
                        ];
                    }
                    if (!isset($heroes[$match->{$i . '_heroid'}]))
                    {
                        $heroes[$match->{$i . '_heroid'}] = 1;
                        $hero_games[$match->{$i . '_heroid'}] = [
                            'total' => 1,
                            'won'   => (($i < 5 && $match->winner == 1) || ($i > 4 && $match->winner == 0)),
                            'kill'  => $match->{$i . '_kill_count'},
                            'death' => $match->{$i . '_death_count'},
                            'assists'=> $match->{$i . '_assists_count'},
                        ];
                    }
                    else
                    {
                        $heroes[$match->{$i . '_heroid'}] += 1;
                        $hero_games[$match->{$i . '_heroid'}]['total']  += 1;
                        $hero_games[$match->{$i . '_heroid'}]['won']    += (($i < 5 && $match->winner == 1) || ($i > 4 && $match->winner == 0)) ? 1 : 0;
                        $hero_games[$match->{$i . '_heroid'}]['kill']   += $match->{$i . '_kill_count'};
                        $hero_games[$match->{$i . '_heroid'}]['death']  += $match->{$i . '_death_count'};
                        $hero_games[$match->{$i . '_heroid'}]['assists'] += $match->{$i . '_assists_count'};
                    }
                }
            }
        }

        asort($heroes, SORT_NUMERIC);
        $heroes = array_reverse(array_slice($heroes, $display_heroes_count*-1, NULL, true), true);

        $hero_games = array_intersect_key($hero_games, $heroes);

        return view('pages.player.show', [
            'language_block'        => $language_block,
            'search_block'          => $search_block,
            'player'                => $player[0],
            'most_popular_heroes'   => $heroes ?? null,
            'percents_won_hero'     => $hero_games ?? 0,
            'player_matches'        => collect($matches)->slice(0, 6),
            'player_hero_in_match'  => $player_hero_in_match,
        ]);
    }
}
