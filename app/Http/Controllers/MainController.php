<?php

namespace App\Http\Controllers;

use App\Custom\Common;
use App\Input\Admin\FutureMatches;
use App\Input\Admin\PastMatches;
use App\Input\Admin\LiveMatches;
use App\Input\Admin\RealtimeStats;
use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{

    public function main($lang)
    {
        $language_block = Common::prepareLanguageBlock();
        $dataPast   = PastMatches::getMatchesPast(['`d2mp`.`league_id`','`d2mp`.`series_id`'],'`d2mp`.`winner` IS NOT NULL','`d2mp`.`timestamp`',5,true);
        $dataLive   = LiveMatches::getMatchesLive([
            '`m`.`match_id`',
            '`m`.`players`',
            '`m`.`radiant_lead`',
            '`m`.`team_id_radiant`',
            '`m`.`team_id_dire`',
            '`m`.`team_name_radiant`',
            '`m`.`team_name_dire`',
            '`m`.`fb_flag`',
            '`m`.`k10_flag`',
            '`m`.`roshan_kill_flag`',
            '`m`.`radiant_score`',
            '`m`.`dire_score`',
            '`m`.`building_state`',
            '`m`.`MStatus`',
            '(SELECT `channel` FROM `z11_laravel`.`streams` WHERE `id` = `m`.`MStreamID` LIMIT 1) AS `stream_channel`',
            '`mrp`.`buildings`',
            '`mrp`.`graph_data`',
            LiveMatches::SQLgetMatchesLiveNumberInSeries,
            LiveMatches::SQLgetMatchesLiveRadiantWinInSeries,
            LiveMatches::SQLgetMatchesLiveDireWinInSeries
        ],false,false,5);
        $dataFuture = FutureMatches::getMatchesFuture([],false,false,5);
        $activeMatchNumber = 0;
        if (isset($dataLive[$activeMatchNumber]))
            $realtimeHeroes = json_decode($dataLive[$activeMatchNumber]->players, true);
        else
            $realtimeHeroes = [];

        $realtimeStats = [];
        $buildingState = [];

        if (isset($dataLive[$activeMatchNumber]) && isset($dataLive[$activeMatchNumber]->match_id) && $dataLive[$activeMatchNumber]->match_id)
        {
            $realtimeStats = RealtimeStats::getRealtimeStats($dataLive[$activeMatchNumber]->match_id);
            $realtimeStats->buildings = json_decode($realtimeStats->buildings, true);
            $realtimeStats->graph_data = json_decode($realtimeStats->graph_data, true);
            if ($dataLive[$activeMatchNumber]->MStatus == env('MSTATUS_LIVE_GET_STATS_L') && $dataLive[$activeMatchNumber]->building_state == 19138340)
            {
                $dataLive[$activeMatchNumber]->building_state = 4784201; // set all towers alive when match starts
            }
            $buildingState = LiveMatches::prepareBuildingStateData($dataLive[$activeMatchNumber]->building_state);
        }

        $search_block = Common::prepareSearchBlock();


        // GET LOGIN/EMAIL FROM COOKIE for chat
        $logged['login'] = Cookie::get('login');
        $logged['email'] = Cookie::get('email');

        if (!$logged['login'] || !$logged['email'])
            $logged = false;

        $messages = Chat::latest()->limit(50)->get()->reverse();

        return view('main', [
            'dataPast' => $dataPast,
            'dataLive' => $dataLive,
            'dataFuture' => $dataFuture,
            'language_block'=>$language_block,
            'realtimeStats' =>$realtimeStats,
            'activeMatchNumber' =>$activeMatchNumber,
            'realtimeHeroes' => $realtimeHeroes,
            'buildingState' => $buildingState,
            'search_block' => $search_block,
            'messages' => $messages,
            'logged' => $logged
        ]);
    }

    public function channel($channel_id)
    {
        if (!is_numeric($channel_id) || $channel_id < 0)
            die();
        $channel_id = (int)$channel_id;
        $dataLive   = LiveMatches::getMatchesLive(
            ['`mrp`.`0_accountid`','`mrp`.`0_name`','`mrp`.`0_team`','`mrp`.`0_heroid`','`mrp`.`0_level`','`mrp`.`0_kill_count`','`mrp`.`0_death_count`','`mrp`.`0_assists_count`','`mrp`.`0_denies_count`',//'`mrp`.`0_gold`',
            '`mrp`.`1_accountid`','`mrp`.`1_name`','`mrp`.`1_team`','`mrp`.`1_heroid`','`mrp`.`1_level`','`mrp`.`1_kill_count`','`mrp`.`1_death_count`','`mrp`.`1_assists_count`','`mrp`.`1_denies_count`',//'`mrp`.`1_gold`',
            '`mrp`.`2_accountid`','`mrp`.`2_name`','`mrp`.`2_team`','`mrp`.`2_heroid`','`mrp`.`2_level`','`mrp`.`2_kill_count`','`mrp`.`2_death_count`','`mrp`.`2_assists_count`','`mrp`.`2_denies_count`',//'`mrp`.`2_gold`',
            '`mrp`.`3_accountid`','`mrp`.`3_name`','`mrp`.`3_team`','`mrp`.`3_heroid`','`mrp`.`3_level`','`mrp`.`3_kill_count`','`mrp`.`3_death_count`','`mrp`.`3_assists_count`','`mrp`.`3_denies_count`',//'`mrp`.`3_gold`',
            '`mrp`.`4_accountid`','`mrp`.`4_name`','`mrp`.`4_team`','`mrp`.`4_heroid`','`mrp`.`4_level`','`mrp`.`4_kill_count`','`mrp`.`4_death_count`','`mrp`.`4_assists_count`','`mrp`.`4_denies_count`',//'`mrp`.`4_gold`',
            '`mrp`.`5_accountid`','`mrp`.`5_name`','`mrp`.`5_team`','`mrp`.`5_heroid`','`mrp`.`5_level`','`mrp`.`5_kill_count`','`mrp`.`5_death_count`','`mrp`.`5_assists_count`','`mrp`.`5_denies_count`',//'`mrp`.`5_gold`',
            '`mrp`.`6_accountid`','`mrp`.`6_name`','`mrp`.`6_team`','`mrp`.`6_heroid`','`mrp`.`6_level`','`mrp`.`6_kill_count`','`mrp`.`6_death_count`','`mrp`.`6_assists_count`','`mrp`.`6_denies_count`',//'`mrp`.`6_gold`',
            '`mrp`.`7_accountid`','`mrp`.`7_name`','`mrp`.`7_team`','`mrp`.`7_heroid`','`mrp`.`7_level`','`mrp`.`7_kill_count`','`mrp`.`7_death_count`','`mrp`.`7_assists_count`','`mrp`.`7_denies_count`',//'`mrp`.`7_gold`',
            '`mrp`.`8_accountid`','`mrp`.`8_name`','`mrp`.`8_team`','`mrp`.`8_heroid`','`mrp`.`8_level`','`mrp`.`8_kill_count`','`mrp`.`8_death_count`','`mrp`.`8_assists_count`','`mrp`.`8_denies_count`',//'`mrp`.`8_gold`',
            '`mrp`.`9_accountid`','`mrp`.`9_name`','`mrp`.`9_team`','`mrp`.`9_heroid`','`mrp`.`9_level`','`mrp`.`9_kill_count`','`mrp`.`9_death_count`','`mrp`.`9_assists_count`','`mrp`.`9_denies_count`',//'`mrp`.`9_gold`',
            '`m`.`match_id`', '`m`.`radiant_lead`', '`m`.`radiant_score`', '`m`.`dire_score`', '`m`.`building_state`', '`m`.`team_id_radiant`', '`m`.`team_id_dire`', '`m`.`map_start`', '`m`.`MStatus`', '(SELECT `channel` FROM `z11_laravel`.`streams` WHERE `id` = `m`.`MStreamID` LIMIT 1) AS `stream_channel`', '`m`.`players`', '`mrp`.`graph_data`'],false,false,$channel_id.',1');
        if (!isset($dataLive[0]))
            die();
        $dataLive = collect($dataLive[0])->toArray();
        if ($dataLive['0_heroid'] && $dataLive['1_heroid'] && $dataLive['2_heroid'] &&
        $dataLive['3_heroid'] && $dataLive['4_heroid'] && $dataLive['5_heroid'] &&
        $dataLive['6_heroid'] && $dataLive['7_heroid'] && $dataLive['8_heroid'] &&
        $dataLive['9_heroid'])
        {
            //if realtime heroid isset
            for ($i = 0; $i < 10; $i++)
            {
                $dataLive[$i.'_avatar'] = $dataLive[$i.'_heroid'];
                unset($dataLive[$i.'_heroid']);
            }
        } else
        {
            //if realtime heroid !isset grab from dota2_matches->players
            $playersAvatars = json_decode($dataLive['players'], true);
            for ($i = 0; $i < 10; $i++)
            {
                if (isset($playersAvatars[$dataLive[$i.'_accountid']]))
                {
                    $dataLive[$i.'_avatar'] = $playersAvatars[$dataLive[$i.'_accountid']];
                } else
                {
                    $dataLive[$i.'_avatar'] = 0;
                }
                unset($dataLive[$i.'_heroid']);
            }
        }
        if ($dataLive['MStatus'] == env('MSTATUS_LIVE_GET_STATS_L') && $dataLive['building_state'] == 19138340)
        {
            $dataLive['building_state'] = 4784201; // set all towers alive when match starts
        }
        $dataLive['building_state'] = LiveMatches::prepareBuildingStateData($dataLive['building_state']);
        unset($dataLive['match_id']);
        unset($dataLive['players']);
        $data = ['data' => $dataLive];
        return json_encode($data);
    }

    public function graphPopup(Request $request)
    {
        $id = (int)$request->id;
        $map_number = (int)$request->map_number;
        if(!is_int($id) or !is_int($map_number)){
            exit();
        }
//        $res = DB::connection('z11_dota2_main')->table('z11_dota2_matches_past')->where('league_id', '=', $request->id)->select('*')->get();
        $pastMatches = PastMatches::getMatchesPast([],'`d2mp`.`series_id` = '.$id.' AND `d2mp`.`number_in_series` = '.$map_number,'`d2mp`.`timestamp`');

        $buildings = LiveMatches::prepareBuildingStateData($pastMatches[0]->{'building_state'});

        $player_ids = [];
        for ($a=0; $a<10; $a++)
        {
            $player_ids[] = $pastMatches[0]->{$a.'_accountid'};
        }

        $res = DB::connection('z11_dota2_history')->table('z11_dota2_players')->whereIn('account_id', $player_ids)->select('*')->get();


        return [
            array(
                'id' => $pastMatches,
                'players' => $res,
                'building' => $buildings

            )
        ];
    }
}
