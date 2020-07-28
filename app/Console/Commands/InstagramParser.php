<?php

namespace App\Console\Commands;

use App\Models\Cosplay;
use Illuminate\Console\Command;
use InstagramScraper\Instagram;
use Phpfastcache\Helper\Psr16Adapter;

class InstagramParser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'instagram:parse';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse 50 latest posts of following accounts';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $instagram = Instagram::withCredentials('oleksiishevchenko5', 'z11cosplaygram0207', new Psr16Adapter('Files'));
        $instagram->login();

        sleep(2);

        $account = $instagram->getAccount('oleksiishevchenko5');
        $followers = $instagram->getFollowing($account->getId(), 20, 20, true); // Get 1000 followings of 'kevin', 100 a time with random delay between requests

        foreach ($followers['accounts'] as $follower)
            foreach ($instagram->getMediasByUserId($follower['id'], 20) as $media)
                Cosplay::firstOrCreate(
                    ['image_id' => $media->getId()],
                    [
                        'image_id' => $media->getId(),
                        'thumbnail_url' => $media->getImageThumbnailUrl(),
                        'origin_url' => $media->getImageHighResolutionUrl(),
                    ]);
    }
}
