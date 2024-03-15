<?php

namespace App\Livewire\Polls;

use App\Facades\PollManager;
use Livewire\Component;

class Vote extends Component
{
    public $answers;

    public $viewSecret;

    public $poll;

    public function mount(): void
    {
        $this->poll = PollManager::findPollByViewSecret($this->viewSecret);
        if (!$this->poll) {
            abort(404);
        }
    }

    public function render()
    {
        return view('livewire.polls.vote')
            ->layout('components.layouts.app', ['title' => __('sites/poll.vote.tab_title', ['title' => $this->poll->title])]);
    }
}
