<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'blog_id', 'content'];

    public function user(){
        return $this->belongsTo(Blog::class);
    }

    public function blog(){
        return $this->belongsTo(Blog::class);
    }
}
