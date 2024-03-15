<?php

namespace App\Exports;

use App\Facades\PollManager;
use App\Models\PollVote;
use Maatwebsite\Excel\Concerns\FromCollection;

class PollVotesExport implements FromCollection
{
    public $votes;

    public function __construct($votes)
    {
        $this->votes = $votes;
    }

    public function collection()
    {
        $votes = PollVote::whereIn('id', $this->votes)->get();

        return $votes->map(function ($vote) {
            $array = json_decode($vote->votes, true);
            $formattedString = PollManager::getPollVotesManager(PollManager::findPollById($vote->poll_id))
                ->getFormattedVotes($array, '', false);

            $vote->votes = $formattedString;

            return $vote;
        });
    }
}
