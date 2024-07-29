<?php
namespace App\Http\Controllers\Auth;

use App\Models\TwitterAccount;
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
                'profile_image' => $twitterUser->avatar,
                'token' => $twitterUser->token,
                'tokenSecret' => $twitterUser->tokenSecret,
            ]);

            // Remove any token-saving logic from the User model

            $twitterAccount = TwitterAccount::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'twitter_id' => $twitterUser->id,
                    'nickname' => $twitterUser->nickname,
                    'name' => $twitterUser->name,
                    'email' => $twitterUser->email,
                    'profile_image' => $twitterUser->avatar,
                    'token' => $twitterUser->token,
                    'token_secret' => $twitterUser->tokenSecret,
                ]
            );

            return redirect()->route('media.index')->with('success', 'Twitter account linked successfully!');
        } catch (\Exception $e) {
            Log::error('Twitter OAuth error:', ['error' => $e->getMessage()]);
            return redirect()->route('media.index')->with('error', 'Failed to authenticate with Twitter.');
        }
    }
}
