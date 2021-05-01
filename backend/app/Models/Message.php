<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'author_id',
        'post_id'
    ];

    /**
     * Get post keeping this message
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * Get tied post
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tiedPost()
    {
        return $this->hasOne(Post::class, 'message_id', 'id');
    }
}
