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
use Revolution\Mastodon\Facades\Mastodon;

class PostOnSocialNetworks implements ShouldQueue, ShouldBeUnique
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

    private function setTwitter()
    {
        try {
            return new TwitterOAuth(
                env('TWITTER_EXPORATOR_CONSUMERKEY', false),
                env('TWITTER_EXPORATOR_CONSUMERSECRET', false),
                env('TWITTER_EXPORATOR_TOKEN', false),
                env('TWITTER_EXPORATOR_TOKENSECRET', false)
            );
        }
        catch (\Throwable $e) {
            report('Twitter: error during the connection for a new place.');
        }
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->exhibition)
        {
            if ($this->exhibition->inPlace->twitter) {
                $status = ucfirst(__('app.send_exhibition_tweetWith', [
                    'what' => $this->exhibition->title,
                    'twitter' => $this->exhibition->inPlace->twitter,
                    'url' => route('front.place.show', ['slug' => $this->exhibition->inPlace->slug]),
                    'site' => $this->exhibition->link,
                ]));
            } else {
                $status = ucfirst(__('app.send_exhibition_tweetWithout', [
                    'what' => $this->exhibition->title,
                    'name' => $this->exhibition->inPlace->name,
                    'url' => route('front.place.show', ['slug' => $this->exhibition->inPlace->slug]),
                    'site' => $this->exhibition->link,
                ]));
            }

            try {
                Mastodon::domain('https://mastodon.art')->token(env('MASTODON_EXPORATOR_TOKEN', false));
                Mastodon::createStatus($status, ['language' => app()->getLocale()]);
            }
            catch (\Throwable $e) {
                report('Mastodon: error during posting a new exhibition.');
            }

            try {
                $this->setTwitter()->post('statuses/update', [
                    'status' => $status,
                ]);
            }
            catch (\Throwable $e) {
                report('Twitter: error during tweeting a new exhibition.');
            }
        }
    }
}
