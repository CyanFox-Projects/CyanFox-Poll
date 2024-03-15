<?php

namespace App\Services\Polls;

use App\Models\PollVote;

class PollAnswersService
{
    public $poll;

    public function __construct($poll)
    {
        $this->poll = $poll;
    }

    /**
     * Deletes an answer from the poll and all corresponding votes.
     *
     * @param  int  $answerId  The ID of the answer to be deleted.
     */
    public function deleteAnswer(int $answerId): void
    {
        $votes = PollVote::where('poll_id', $this->poll->id)->get();

        foreach ($votes as $vote) {
            $selectedPollAnswers = json_decode($vote->votes, true);
            $selectedPollAnswers = array_filter($selectedPollAnswers, function ($selectedPollAnswer) use ($answerId) {
                return $selectedPollAnswer['poll_answer_id'] != $answerId;
            });

            if (empty($selectedPollAnswers)) {
                $vote->delete();

                continue;
            }

            $vote->update([
                'votes' => json_encode($selectedPollAnswers),
            ]);
        }

        $this->poll->pollAnswers()->where('id', $answerId)->delete();
    }
}
