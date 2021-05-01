<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Directory extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
      'name'
    ];
    /**
     * Get child directories
     */
    public function childDirectories()
    {
        return $this->hasMany(Directory::class, 'parent_id', 'id');
    }

    /**
     *  Get parent directory
     */
    public function parentDirectory()
    {
        return $this->belongsTo(Directory::class, 'id', 'parent_id');
    }

    /**
     * Get child posts
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
