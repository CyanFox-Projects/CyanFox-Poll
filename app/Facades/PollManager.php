<?php

namespace App\Facades;

use App\Models\Poll;
use App\Services\Polls\PollAnswersService;
use App\Services\Polls\PollService;
use App\Services\Polls\PollVotesService;
use Illuminate\Support\Facades\Facade;

/**
 * @method static Poll|null findPollById($pollId)
 * @method static Poll|null findPollByAdminSecret($adminSecret)
 * @method static Poll|null findPollByViewSecret($viewSecret)
 * @method static PollVotesService getPollVotesManager($poll)
 * @method static PollAnswersService getPollAnswersManager($poll)
 */
class PollManager extends Facade
{
    protected static function getFacadeAccessor()
    {
        return PollService::class;
    }
}
