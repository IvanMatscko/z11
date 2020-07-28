<?php

namespace App\Http\Controllers;

use App\Models\ChatCensor;
use Illuminate\Http\Request;

class ChatCensorController extends Controller
{
    public function index(Request $request)
    {
        $words = ChatCensor::where('from', 'like', "%" .$request->from. "%")->where('to', 'like', "%" .$request->to. "%")->latest()->paginate();

        return view('admin.badWords.index', [
            'words' => $words
        ]);
    }

    public function create()
    {
        return view('admin.badWords.edit');
    }

    public function edit(ChatCensor $bword)
    {
        return view('admin.badWords.edit', [
            'word' => $bword
        ]);
    }

    public function store(Request $request)
    {
        /*
         * if isset word "FROM" -> we are changing "TO"
         * else creating row
         */
        ChatCensor::updateOrCreate([
            'from' => $request->from
        ], [
            'to' => $request->to,
        ]);

        return redirect( route('bwords.index') )->with('status', 'Success!');
    }

    public function destroy(ChatCensor $bword)
    {
        $bword->delete();

        return back()->with('status', 'Success!');
    }

    public static function checkSentence(string $string)
    {
        $words = ChatCensor::all();
        $badWords = array_map( [ChatCensorController::class, 'badWordsArrayChanger'], $words->pluck('from')->toArray());
        $goodWords = $words->pluck('to')->toArray();

        $string = preg_replace(
            $badWords,
            $goodWords,
            $string);

        $string = strip_tags($string);
        $string = preg_replace('/^\@([a-zA-z0-9]+)\b/', '-> <span style="color: green;">$1</span>', $string);

        return $string;
    }

    public static function badWordsArrayChanger($item)
    {
        return "/\b$item\b/iu";
    }
}
