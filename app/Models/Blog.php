<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'categories',
        'posted_at'
    ];

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeFilter($query, array $filters){
    //     if($filters['category'] ?? false){
    //         $query->where('categories', 'like', '%' .request('category').'%');
    //     }
        if($filters['search'] ?? false){
            $query->where('title', 'like', '%' .request('search').'%')
                ->orWhere('content', 'like', '%' .request('search').'%')
                ->orWhere('categories', 'like', '%' .request('search').'%');
            }
    }
}
