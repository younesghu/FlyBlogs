<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TwitterAccount extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'nickname',
        'name',
        'email',
        'profile_image',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
