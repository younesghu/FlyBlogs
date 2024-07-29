<?php
namespace App\Services;

use Abraham\TwitterOAuth\TwitterOAuth;

class TwitterService
{
    public function postTweet($user, $message)
    {
        $connection = new TwitterOAuth(
            config('services.twitter.client_id'),
            config('services.twitter.client_secret'),
            $user->twitter_token,
            $user->twitter_token_secret
        );
        return $connection->post('statuses/update', ['status' => $message]);
    }
}
