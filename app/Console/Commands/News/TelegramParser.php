<?php

namespace App\Console\Commands\News;

use App\Models\NewsBan;
use App\Models\NewsSource;
use Illuminate\Console\Command;

class TelegramParser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'telegram:parse';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse latest news from telegram';

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
        echo '=======TELEGRAM==PARSER==START====='.PHP_EOL;

        $sources = NewsSource::where('type', 'tg')->get();

        foreach ($sources as $source)
        {
            echo 'Start parse @' . $source->source . PHP_EOL;

            if ( $this->isBaned($source->source) ) continue;

            $settings = [
                'app_info' => [
                    'api_id' => '1446773',
                    'api_hash' => '593cc113fc81fcbf7e9c2f365ab398ec',
                ],
                'logger' => [
                    'logger' => 0,
                    'logger_level' => 0,
                ],
                'serialization' => [
                    'serialization_interval' => 300,
                    'cleanup_before_serialization' => true,
                ],
            ];

            $MadelineProto = new \danog\MadelineProto\API('session.madeline', $settings);
            $MadelineProto->start();


            $data = [
                'peer' => '@' .$source->source,
                'offset_id' => 0,
                'offset_date' => 0,
                'add_offset' => 0,
                'limit' => 10,
                'max_id' => 0,
                'min_id' => 0,
                'hash' => 0
            ];

            $response = $MadelineProto->messages->getHistory($data);

            foreach( $response['messages'] as $post)
            {
                \App\Models\News::where('post_id', $post['id'])->update(['active' => 0]);
                $model = \App\Models\News::create([
                    'chanel_id' => $source->id,
                    'post_id' => $post['id'],
                    'content' => $post['message'],
                    'views' => $post['views'],
                    'active' => 1,
                    'post_created' => $post['date'],
                    'locale' => $source->locale,
                    'game' => $source->game,
                    'source' => 'tg',
                ]);

            }

            echo 'End parse @' . $source->source . PHP_EOL;
        }

        echo '=======TELEGRAM==PARSER==END======='.PHP_EOL;
    }

    public function isBaned(string $channel_name)
    {
        if ( !NewsBan::where('name', $channel_name)->first() ) return false;

        echo 'Source BANNED' . PHP_EOL;
        echo 'End parse @' . $channel_name . PHP_EOL;
        return true;
    }
}
