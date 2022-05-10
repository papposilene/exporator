<?php

namespace App\Jobs;

use App\Models\Exhibition;
use Abraham\TwitterOAuth\TwitterOAuth;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PostOnSocialNetworks implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Exhibition $exhibition
     */
    private $exhibition;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Exhibition $exhibition)
    {
        $this->onQueue('socialnetworking');
        $this->exhibition = $exhibition;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->exhibition) {
            // Twitter API: set up the connection before tweeting about the new place
            try {
                $twitter = new TwitterOAuth(
                    env('TWITTER_EXPORATOR_CONSUMERKEY', false),
                    env('TWITTER_EXPORATOR_CONSUMERSECRET', false),
                    env('TWITTER_EXPORATOR_TOKEN', false),
                    env('TWITTER_EXPORATOR_TOKENSECRET', false)
                );
            }
            catch (\Throwable $e) {
                report('Twitter: error during the connection for a new place.');
            }

            try {
                $tweet = ucfirst(__('app.send_exhibition_tweet', [
                    'what' => $this->exhibition->title,
                    'twitter' => $this->exhibition->inPlace->twitter,
                    'url' => route('front.place.show', ['slug' => $this->exhibition->inPlace->slug]),
                    'site' => $this->exhibition->link,
                ]));

                $twitter->post('statuses/update', [
                    'status' => $tweet,
                ]);
            }
            catch (\Throwable $e) {
                report('Twitter: error during tweeting a new place.');
            }
        }
    }
}
