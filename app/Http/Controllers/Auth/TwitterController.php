<?php
namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class TwitterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function redirectToTwitter()
    {
        try {
            Log::info('Redirecting to Twitter for authentication');
            $redirect = Socialite::driver('twitter')->redirect();
            Log::info('Redirect URL: ' . $redirect->getTargetUrl());
            return $redirect;
        } catch (\Exception $e) {
            Log::error('Error redirecting to Twitter: ' . $e->getMessage());
            return redirect()->route('media.index')->with('error', 'Failed to redirect to Twitter.');
        }
    }

    public function handleTwitterCallback()
    {
        try {
            Log::info('Handling Twitter callback');
            $twitterUser = Socialite::driver('twitter')->user();
            Log::info('Twitter user retrieved', ['user' => $twitterUser]);

            $user = Auth::user();
            $user->twitter_token = $twitterUser->token;
            $user->twitter_token_secret = $twitterUser->tokenSecret;
            $user->save();

            Log::info('Twitter account linked successfully for user', ['user_id' => $user->id]);

            return redirect()->route('media.index')->with('success', 'Twitter account linked successfully!');
        } catch (\Exception $e) {
            Log::error('Error handling Twitter callback: ' . $e->getMessage());
            return redirect()->route('media.index')->with('error', 'Failed to authenticate with Twitter.');
        }
    }
}
