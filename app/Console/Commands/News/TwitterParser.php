<?php

namespace App\Console\Commands\News;

use App\Models\NewsBan;
use App\Models\NewsSource;
use Illuminate\Console\Command;

class TwitterParser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'twitter:parse';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse latest news from tweeter';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        echo '=======TWITTER===PARSER==START====='.PHP_EOL;
        $settings = [
            'oauth_access_token' => "1278812664026841088-SB1U2d8yl51P0sSPw4g2GmhZ0bCAoF",
            'oauth_access_token_secret' => "tJaO4sI0WjVfOsDzgjyWxkKttab9SF8Q1VtAoihoimO63",
            'consumer_key' => "reEgJbr1rRCdb6yOfEOtGyaBC",
            'consumer_secret' => "H01XzoZgz4pfSBZE2qT6M7lOD4rWwtbgA2tJbVZa3zooislN2Z"
        ];
        $url = 'https://api.twitter.com/1.1/statuses/home_timeline.json';
        $getfield = '?include_entities=false&&count=50';
        $requestMethod = 'GET';

        $twitter = new \TwitterAPIExchange($settings);
        $response = json_decode($twitter->setGetfield($getfield)
            ->buildOauth($url, $requestMethod)
            ->performRequest(), true);

        foreach ($response as $item)
        {
            if ($this->isBaned($item['user']['screen_name'])) continue;

            $source = NewsSource::where('source', $item['user']['screen_name'])->first();
            if ( !$source ) continue;

            \App\Models\News::where('post_id', $item['id'])->update(['active' => 0]);
            $model = \App\Models\News::create([
                'chanel_id' => $source->id,
                'post_id' => $item['id'],
                'content' => $item['text'],
                'views' => 0,
                'likes' => $item['favorite_count'],
                'replies' => $item['retweet_count'],
                'active' => 1,
                'post_created' => strtotime($item['created_at']),
                'source' => 'tw',
                'locale' => $source->locale,
                'game' => $source->game,
            ]);
        }
        echo '=======TWITTER===PARSER==END======='.PHP_EOL;
    }


    public function isBaned(string $channel_name)
    {
        if ( !NewsBan::where('name', $channel_name)->first() ) return false;

        echo 'Source ' .$channel_name. ' BANNED' . PHP_EOL;
        return true;
    }
}
