<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'header',
        'author_id',
        'directory_id'
    ];
    protected $with = ['author:id,name'];

    /**
     * Get parent directory
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function directory()
    {
        return $this->belongsTo(Directory::class);
    }

    /**
     * Get author of this post
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function initMessage()
    {
        return $this->belongsTo(Message::class, 'message_id','id');
    }
}
