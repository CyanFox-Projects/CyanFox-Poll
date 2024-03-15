<?php

namespace App\Livewire\Components\Modals\Polls;

use LivewireUI\Modal\ModalComponent;

class AddPollAnswer extends ModalComponent
{
    public $title;

    public $maxVotes = 1;

    public $unlimitedVotes = true;

    public $useCustomInput = false;

    public function addPollAnswer(): void
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'maxVotes' => 'required|integer|min:1',
            'unlimitedVotes' => 'required|boolean',
            'useCustomInput' => 'required|boolean',
        ]);

        $this->closeModal();
        $this->dispatch('addPollAnswer', [
            'title' => $this->title,
            'maxVotes' => $this->maxVotes,
            'useUnlimitedVotes' => $this->unlimitedVotes,
            'useCustomInput' => $this->useCustomInput,
        ]);

    }

    public function render()
    {
        return view('livewire.components.modals.polls.add-poll-answer');
    }
}
