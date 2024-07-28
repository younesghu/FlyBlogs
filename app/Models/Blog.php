<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Blog extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'blog_img',
        'categories',
        'likes',
        'scheduled_at',
        'is_scheduled',
        'posted_at'
    ];

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeFilter($query, array $filters){
        if($filters['category'] ?? false){
            $query->where('categories', 'like', '%' .request('category').'%');
        }
        if($filters['search'] ?? false){
            $query->where('title', 'like', '%' .request('search').'%')
                ->orWhere('content', 'like', '%' .request('search').'%')
                ->orWhere('categories', 'like', '%' .request('search').'%');
            }
    }
    public function likes()
    {
        return $this->belongsToMany(User::class, 'likes');
    }
}
