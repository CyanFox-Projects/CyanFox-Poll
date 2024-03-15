<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PollAnswer extends Model
{
    protected $fillable = ['title', 'votes', 'max_votes', 'unlimited_votes', 'custom_input'];

    public function poll()
    {
        return $this->belongsTo(Poll::class);
    }
}
