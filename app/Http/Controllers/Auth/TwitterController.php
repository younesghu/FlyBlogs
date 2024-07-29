<?php
namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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

            // Log Twitter user details for debugging
            Log::info('Twitter User:', [
                'id' => $twitterUser->id,
                'nickname' => $twitterUser->nickname,
                'name' => $twitterUser->name,
                'email' => $twitterUser->email,
                'token' => $twitterUser->token,
                'tokenSecret' => $twitterUser->tokenSecret,
            ]);

            $user->twitter_token = $twitterUser->token;
            $user->twitter_token_secret = $twitterUser->tokenSecret;
            $user->save();

            return redirect()->route('media.index')->with('success', 'Twitter account linked successfully!');
        } catch (\Exception $e) {
            Log::error('Twitter OAuth error:', ['error' => $e->getMessage()]);
            return redirect()->route('media.index')->with('error', 'Failed to authenticate with Twitter.');
        }
    }
}
