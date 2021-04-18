<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['comment', 'username', 'parent_post_id', 'parent_reply_id'];

    /**
     * Get the reply associated with post.
     */
    public function reply()
    {
        return $this->hasMany(Post::class, 'parent_post_id', 'id');
    }

    /**
     * Get the sub reply associated with reply.
     */
    public function subReply()
    {
        return $this->hasMany(Post::class, 'parent_reply_id', 'id');
    }

    /**
     * Prepare a date for array / JSON serialization.
     *
     * @param  \DateTimeInterface  $date
     * @return string
     */
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
