<?php

namespace App\Services\Polls;

use App\Models\Poll;

class PollVotesService
{
    public $poll;

    public function __construct($poll)
    {
        $this->poll = $poll;
    }

    /**
     * Add a vote to the poll.
     *
     * @param  string  $name  The name of the voter.
     * @param  array  $selectedPollAnswers  The selected poll answers.
     */
    public function addVote(string $name, array $selectedPollAnswers): void
    {
        foreach ($selectedPollAnswers as $item) {
            $pollAnswer = Poll::find($this->poll->id)->pollAnswers()->find($item['poll_answer_id']);
            if (!$pollAnswer->max_votes > $pollAnswer->votes && !$pollAnswer->unlimited_votes) {
                return;
            }
            $pollAnswer->update([
                'votes' => $pollAnswer->votes + 1,
            ]);
        }

        $this->poll->pollVotes()->create([
            'name' => $name,
            'votes' => json_encode($selectedPollAnswers),
        ]);

    }

    /**
     * Deletes a vote from the poll.
     *
     * @param  int  $voteId  The ID of the vote to be deleted.
     */
    public function deleteVote(int $voteId): void
    {
        $vote = $this->poll->pollVotes()->find($voteId);
        $selectedPollAnswers = json_decode($vote->votes, true);
        foreach ($selectedPollAnswers as $item) {
            $pollAnswer = Poll::find($this->poll->id)->pollAnswers()->find($item['poll_answer_id']);
            $pollAnswer->update([
                'votes' => $pollAnswer->votes - 1,
            ]);
        }
        $vote->delete();
    }

    /**
     * Formats the votes for a given array of poll answers.
     *
     * @param  mixed  $array  The array of poll answers.
     * @param  string  $formattedString  The initial string to format the votes.
     * @param  bool  $useHTML  Whether to use HTML formatting (default is true).
     * @return string The formatted votes.
     */
    public function getFormattedVotes(mixed $array, string $formattedString, bool $useHTML = true): string
    {
        foreach ($array as $item) {
            $pollAnswer = $this->poll->pollAnswers()->find($item['poll_answer_id']);
            if ($pollAnswer->unlimited_votes) {
                $name = $pollAnswer->title;
            } else {
                $name = $pollAnswer->title.' ('.$pollAnswer->votes.'/'.$pollAnswer->max_votes.' '.__('sites/poll.votes').')';
            }

            if ($item['custom_input'] == null) {
                $formattedString .= $name.($useHTML ? ' <br>' : '; ');

                continue;
            }
            $formattedString .= $name.' => '.$item['custom_input'].($useHTML ? ' <br>' : '; ');
        }

        return $formattedString;
    }
}
