<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'header',
        'directory_id',
        'author_id'
    ];

    /**
     * Get parent directory
     */
    public function directory()
    {
        return $this->belongsTo(Directory::class);
    }
    /**
     * Get author of this post
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'author_id');
    }
}
