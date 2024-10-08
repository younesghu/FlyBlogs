<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\TwitterAccount;
use Laravel\Sanctum\HasApiTokens;
use App\Models\SocialMediaAccount;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'user_img',
        'password',
        'twitter_token',
        'twitter_token_secret',
        'twitter_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'twitter_token',
        'twitter_token_secret'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function blogs() {
        return $this->hasMany(Blog::class, 'user_id');
    }
    public function comments() {
        return $this->hasMany(Comment::class, 'user_id');
    }
    public function likes()
    {
        return $this->belongsToMany(Blog::class, 'likes');
    }

    public function like(Blog $blog)
    {
        return $this->likes()->attach($blog);
    }

    public function unlike(Blog $blog)
    {
        return $this->likes()->detach($blog);
    }

    public function hasLiked(Blog $blog)
    {
        return $this->likes()->where('blog_id', $blog->id)->exists();
    }
    public function twitterAccount()
    {
        return $this->hasOne(TwitterAccount::class);
    }
}
