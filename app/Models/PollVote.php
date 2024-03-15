<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PollVote extends Model
{
    protected $fillable = ['poll_id', 'name', 'votes'];

    public function poll()
    {
        return $this->belongsTo(Poll::class);
    }
}
