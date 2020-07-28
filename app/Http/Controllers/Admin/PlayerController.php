<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Player\CreatePlayerRequest;
use App\Http\Requests\Player\EditPlayerRequest;
use App\Player;
use App\Team;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;

class PlayerController extends Controller
{
    /**
     * @var array
     */
    private $positions;

    /**
     * @var array
     */
    private $teams;

    public function __construct()
    {
        $this->middleware('auth');
        $this->teams     = Team::all();
        $this->positions = Player::player_positions();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $players = Player::with('team')->orderByDesc('account_id')->get();

        return view('admin/admin-players', [
            'data'    => [
                'route' => RouteServiceProvider::HOME,
            ],
            'players' => $players,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/players/create', [
            'data'      => [
                'route' => RouteServiceProvider::HOME,
            ],
            'teams'     => $this->teams,
            'positions' => $this->positions,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Player\CreatePlayerRequest $request
     *
     * @return void
     */
    public function store(CreatePlayerRequest $request)
    {
        try {

            $this->upload_player_logo($request, $request->input('account_id'));

            Player::create_player($request->only('account_id', 'player_name', 'age', 'position', 'team_id'));

        } catch (\Exception $e) {
            return back()->with('errors', $e->getMessage());
        }

        return redirect()->route('players.index')
            ->with('success', trans('l.player_admin.success_create'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Player $player
     *
     * @return void
     */
    public function edit(Player $player)
    {
        return view('admin/players/edit', [
            'data'      => [
                'route' => RouteServiceProvider::HOME,
            ],
            'teams'     => $this->teams,
            'positions' => $this->positions,
            'player'    => $player,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Player\EditPlayerRequest $request
     * @param \App\Player $player
     *
     * @return void
     */
    public function update(EditPlayerRequest $request, Player $player)
    {
        try {

            $this->upload_player_logo($request, $request->input('account_id'));

            $player->update_player($request->only('account_id', 'player_name', 'age', 'position', 'team_id'));

        } catch (\Exception $e) {
            return back()->with('errors', $e->getMessage());
        }

        return redirect()->route('players.index')
            ->with('success', trans('l.player_admin.success_edit'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Player $player
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Player $player)
    {
        $player->delete();

        return redirect()->route('players.index')
            ->with('success', trans('l.player_admin.success_delete'));
    }

    private function upload_player_logo(Request $request, int $account_id)
    {
        if ($request->hasFile('player_logo')) {
            $player_logo = $request->file('player_logo');
            $image_name  = $account_id .'.'. $player_logo->getClientOriginalExtension();

            $player_logo->move(public_path() . '/img/players/', $image_name);
        }
    }
}
