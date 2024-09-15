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
            // Get user details from Twitter after authentication
            $twitterUser = Socialite::driver('twitter')->user();
            $user = Auth::user();

            // Check if the user is authenticated
            if (!$user) {
                return redirect()->route('login')->with('error', 'User not authenticated');
            }

            // Save tokens to the users table
            $user->twitter_token = $twitterUser->token;
            $user->twitter_token_secret = $twitterUser->tokenSecret;
            $user->twitter_id = $twitterUser->id;
            $user->save();

            // Save or update Twitter user details in the TwitterAccount model
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
        $user = User::find($userId);


        // Ensure user has valid Twitter tokens
        if (!$user || !$user->twitter_token || !$user->twitter_token_secret) {
            Log::error('Twitter tokens not found for user', ['user_id' => $userId]);
            return redirect()->route('media.index')->with('error', 'Twitter tokens not found.');
        }

        // Initialize TwitterOAuth connection with credentials
        $connection = new TwitterOAuth(
            config('services.twitter.client_id'), // API Key
            config('services.twitter.client_secret'), // API Secret Key
            $user->twitter_token,
            $user->twitter_token_secret
        );

        $connection->setApiVersion('2');
        $tweetContent = $blog->title . "\n\n" . Str::limit(strip_tags($blog->content), 240);

        try {
            // Post the tweet to Twitter
            $response = $connection->post("tweets", ["text" => $tweetContent]);

            if ($connection->getLastHttpCode() == 201) {
                Log::info('Posted tweet', ['tweet' => $response]);
                return redirect('/');
            } else {
                Log::error('Failed to post blog as tweet', ['response' => $response]);
                return redirect('/');
            }
        } catch (\Exception $e) {
            Log::error('Failed to post blog as tweet', ['error' => $e->getMessage()]);
            return redirect('/');
        }
    }
    public function destroy()
    {
        // Ensure user is authenticated
        $user = Auth::user();
        if (!$user) {
            return redirect()->back()->with('error', 'User not authenticated.');
        }

        // Check if user has a Twitter account linked
        if (!$user->twitterAccount) {
            return redirect()->back()->with('error', 'No Twitter account linked.');
        }

        // Delete the Twitter account
        $user->twitterAccount()->delete();

        // Debugging message
        return redirect()->route('media.index')->with('success', 'Twitter account has been removed successfully.');
    }
}
