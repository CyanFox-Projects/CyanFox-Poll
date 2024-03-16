<?php

namespace App\Services\Polls;

use App\Models\Poll;

class PollService
{
    /**
     * Finds a poll by its ID.
     *
     * @param  int  $pollId  The ID of the poll to find.
     * @return Poll|null The found poll object, or null if no poll is found.
     */
    public function findPollById(int $pollId): ?Poll
    {
        return Poll::find($pollId);
    }

    /**
     * Find a Poll by the admin secret.
     *
     * @param  string  $adminSecret  The admin secret to search for.
     * @return ?Poll Returns the found Poll object or null if not found.
     */
    public function findPollByAdminSecret(string $adminSecret): ?Poll
    {
        return Poll::where('admin_secret', $adminSecret)->first();
    }

    /**
     * Find a poll by its view secret.
     *
     * @param  string  $viewSecret  The view secret of the poll.
     * @return Poll|null The found poll or null if not found.
     */
    public function findPollByViewSecret(string $viewSecret): ?Poll
    {
        return Poll::where('view_secret', $viewSecret)->first();
    }

    /**
     * Retrieves the PollVotesService instance for the given poll.
     *
     * @param  Poll  $poll  The poll object for which to retrieve the PollVotesService instance.
     * @return PollVotesService A PollVotesService instance that is associated with the given poll.
     */
    public function getPollVotesManager(Poll $poll): PollVotesService
    {
        return new PollVotesService($poll);
    }

    /**
     * Retrieves an instance of the PollAnswersService class.
     *
     * @param  $poll  Poll poll object for which the PollAnswersService instance is required.
     * @return PollAnswersService An instance of the PollAnswersService class.
     */
    public function getPollAnswersManager(Poll $poll): PollAnswersService
    {
        return new PollAnswersService($poll);
    }
}
