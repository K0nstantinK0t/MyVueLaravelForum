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
}
