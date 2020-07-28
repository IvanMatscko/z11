<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\ChatCensor;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;

class ChatController extends Controller
{
    public function index()
    {
        $logged['login'] = Cookie::get('login');
        $logged['email'] = Cookie::get('email');

        if (!$logged['login'] || !$logged['email'])
            $logged = false;

        $messages = Chat::latest()->get();
        $badWords = ChatCensor::all();

        return view('chat.index', [
            'messages' => $messages,
            'badWords' => $badWords,
            'logged' => $logged
        ]);
    }

    public function logout()
    {
        Cookie::queue( Cookie::forget('login') );
        Cookie::queue( Cookie::forget('email') );

        return back();
    }

    public function saveUser(Request $request)
    {
        //check if real email domain
        if ( !preg_match('/ukr\.net|gmail\.com|mail\.ru|yandex\.ru|mail\.ua/', $request->email))
            return back();

        $user = User::where('login', $request->login)->where('email', $request->email)->first();

        if (!$user)
        {
            $this->validator($request->all())->validate();

            User::create([
                'login' => $request->login,
                'email' => $request->email,
                'role' => 20,
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            ]);
        }

        Cookie::queue('login', $request->login, 9999);
        Cookie::queue('email', $request->email, 9999);


        return back();
    }

    public function validator(array $data)
    {
        return Validator::make($data, [
            'login' => ['required', 'string', 'min:4', 'max:16', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);
    }

    public function store(Request $request)
    {
        $message = ChatCensorController::checkSentence($request->message);

        $data = Chat::create([
            'login' => Cookie::get('login'),
            'email' => Cookie::get('email'),
            'message' => $message
        ]);

        if ($data->user->role >= 50)
            $data->login = $data->login.' | Admin';

        return $data->makeHidden('email')->toArray();
    }

    public function destroy(Chat $chat)
    {
        $chat->delete();

        return back();
    }
}
