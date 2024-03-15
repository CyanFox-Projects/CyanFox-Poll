<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    protected $fillable = ['title', 'description', 'admin_secret', 'view_secret', 'end_date', 'email'];

    protected array $dates = ['end_date'];

    public function pollAnswers()
    {
        return $this->hasMany(PollAnswer::class);
    }

    public function pollVotes()
    {
        return $this->hasMany(PollVote::class);
    }
}
