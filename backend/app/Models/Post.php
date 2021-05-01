<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'header',
        'author_id',
        'directory_id'
    ];

    /**
     * Get parent directory
     * @return BelongsTo
     */
    public function directory()
    {
        return $this->belongsTo(Directory::class);
    }

    /**
     * Get author of this post
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'author_id');
    }

    /**
     * Get post's messages
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    /**
     * Get init message.
     * Init message is the first message in the post created by post's author.
     * @return BelongsTo
     */
    public function initMessage()
    {
        return $this->belongsTo(Message::class, 'id','message_id');
    }
}
