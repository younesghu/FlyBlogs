<?php
namespace App\Http\Controllers\Auth;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\TwitterAccount;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Abraham\TwitterOAuth\TwitterOAuth;
use Laravel\Socialite\Facades\Socialite;

class TwitterController extends Controller
{
    public function redirectToTwitter()
    {
        return Socialite::driver('twitter')->redirect();
    }

    public function handleTwitterCallback()
    {
        try {
            $twitterUser = Socialite::driver('twitter')->user();
            $user = Auth::user();

            if (!$user) {
                return redirect()->route('login')->with('error', 'User not authenticated');
            }

            // Save tokens to the users table
            $user->twitter_token = $twitterUser->token;
            $user->twitter_token_secret = $twitterUser->tokenSecret;
            $user->twitter_id = $twitterUser->id;
            $user->save();

            // Save other Twitter user details
            TwitterAccount::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'nickname' => $twitterUser->nickname,
                    'name' => $twitterUser->name,
                    'profile_image' => $twitterUser->avatar,
                ]
            );

            return redirect()->route('media.index')->with('success', 'Twitter account linked successfully!');
        } catch (\Exception $e) {
            Log::error('Twitter OAuth error:', ['error' => $e->getMessage()]);
            return redirect()->route('media.index')->with('error', 'Failed to authenticate with Twitter.');
        }
    }
        public function postBlogAsTweet(Blog $blog, $userId)
        {
            $user = Auth::user();
            $userId = Auth::id();

            // Fetch tokens from the users table
            if (!$user || !$user->twitter_token || !$user->twitter_token_secret) {
                Log::error('Twitter tokens not found for user', ['user_id' => $userId]);
                return redirect()->route('media.index')->with('error', 'Twitter tokens not found.');
            }

            // Use the TwitterOAuth library to post the tweet
            $connection = new TwitterOAuth(
                config('services.twitter.client_id'), // API Key
                config('services.twitter.client_secret'), // API Secret Key
                $user->twitter_token,
                $user->twitter_token_secret
            );

            $connection->setApiVersion('2');
            $tweetContent = $blog->title . "\n\n" . Str::limit($blog->content, 240);

            try {
                $response = $connection->post("tweets", ["text" => $tweetContent]);

                if ($connection->getLastHttpCode() == 201) {
                    Log::info('Posted tweet', ['tweet' => $response]);
                    return redirect('/')->with('success', 'Blog posted successfully and tweeted!');
                } else {
                    Log::error('Failed to post blog as tweet', ['response' => $response]);
                    return redirect('/')->with('error', 'Failed to post blog as tweet.');
                }
            } catch (\Exception $e) {
                Log::error('Failed to post blog as tweet', ['error' => $e->getMessage()]);
                return redirect('/')->with('error', 'Failed to post blog as tweet.');
            }
            // $tweetContent = "SHIIT IT IS WORKING" . now();
            // $response = $connection->post('tweets', ['text' => $tweetContent]);

            // Log::info('Tweet response', ['response' => $response]);

            // // Check response status
            // if ($connection->getLastHttpCode() == 201) {
            //     return redirect('/')->with('success', 'Tweet posted successfully!');
            // } else {
            //     return redirect('/')->with('error', 'Failed to post tweet.');
            // }
        }
    // public function postBlogAsTweet(Blog $blog, $userId)
    // {
    //     $twitterAccount = TwitterAccount::where('user_id', $userId)->first();

    //     if (!$twitterAccount) {
    //         Log::error('Twitter account not linked for user', ['user_id' => $userId]);
    //         return redirect()->route('media.index')->with('error', 'Twitter account not linked.');
    //     }

    //     // Use the TwitterOAuth library to post the tweet
    //     $connection = new TwitterOAuth(
    //         config('services.twitter.client_id'), // API Key
    //         config('services.twitter.client_secret'), // API Secret Key
    //         $twitterAccount->token,
    //         $twitterAccount->token_secret
    //     );

    //     try {
    //         $tweet = $connection->post("statuses/update", ["status" => $blog->title]);
    //         Log::info('Posted tweet', ['tweet' => $tweet]);
    //         return redirect('/')->with('success', 'Blog posted successfully and tweeted!');
    //     } catch (\Exception $e) {
    //         Log::error('Failed to post blog as tweet', ['error' => $e->getMessage()]);
    //         return redirect('/')->with('error', 'Failed to post blog as tweet.');
    //     }
    // }
}
