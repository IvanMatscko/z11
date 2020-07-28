<?php


namespace App\ViewComposers;

use App\League;
use Illuminate\View\View;

class AllLeaguesComposer
{
    /**
     * @var \App\League
     */
    private $league;

    /**
     * AllLeaguesComposer constructor.
     *
     * @param \App\League $league
     */
    public function __construct(League $league)
    {
        $this->league = $league;
    }

    public function compose(View $view)
    {
        $all_leagues = $this->league->all()->sortByDesc('LID');

        foreach ($all_leagues as $k => $league) {
            $allLeagues[$league->LStatus][] = $league;
        }

        /** @var array $allLeagues */
        $view->with('all_leagues', $allLeagues);
    }
}
