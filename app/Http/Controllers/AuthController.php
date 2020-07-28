<?php


namespace App\Http\Controllers;

// /*sockets*/
// require_once env('BASE_DIR').'/include/socket/vendor/autoload.php';
// use ElephantIO\Client;
// use ElephantIO\Engine\SocketIO\Version2X;

/*laravel modules*/

use App\User;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\Input\Admin\Configurations;
use App\Input\Admin\Heroes;
use App\Input\Admin\Countries;
use App\Input\Admin\Trainers;

class AuthController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function globalConfigurations()
    {
        $params = Configurations::getGlobalConfiguration();
        return view('admin/admin-main', [
            'data'=>[
                'route' => RouteServiceProvider::HOME,
                'params' => $params,
            ]
        ]);
    }

    public function inputGlobalConfigurations(Request $request)
    {
        $input = $request->all();

        if (isset($input['dota2_configure']) && is_array($input['dota2_configure']) && !empty($input['dota2_configure']))
        {
            $fields = [];
            foreach ($input['dota2_configure'] as $param_name => $param)
            {
                $fields[$param_name] = $param['value'];
            }
            Configurations::saveGlobalConfiguration($fields);
        }
        $params = Configurations::getGlobalConfiguration();
        return view('admin/admin-main', [
            'data'=>[
                'route' => RouteServiceProvider::HOME,
                'params' => $params,
            ]
        ]);
    }

    public function countries()
    {
        $countries = Countries::getCountries([],false,'country_tag');
        return view('admin/admin-countries', [
            'data'=>[
                'route' => RouteServiceProvider::HOME,
                'countries' => $countries,
            ]
        ]);
    }

    public function heroes()
    {
        $heroes = Heroes::getHeroes([],false,'hero_id');
        return view('admin/admin-heroes', [
            'data'=>[
                'route' => RouteServiceProvider::HOME,
                'heroes' => $heroes,
            ]
        ]);
    }

    public function trainers()
    {
        $trainers = Trainers::getTrainers([],false,'trainer_id');
        return view('admin/admin-trainers', [
            'data'=>[
                'route' => RouteServiceProvider::HOME,
                'trainers' => $trainers,
            ]
        ]);
    }

    public function users()
    {
        $users = User::latest()->paginate();

        return view('admin/admin-users', [
            'users' => $users,
            'data'=>[
                'route' => RouteServiceProvider::HOME,
            ]
        ]);
    }

    public function coefficients()
    {
        return view('admin/admin-coefficients', [
            'data'=>[
                'route' => RouteServiceProvider::HOME,
            ]
        ]);
    }

}
