<?php

namespace App\Livewire\Components\Modals\Polls;

use App\Models\Poll;
use Exception;
use Filament\Notifications\Notification;
use LivewireUI\Modal\ModalComponent;

class UpdatePollAnswer extends ModalComponent
{
    public $answerId;

    public $pollId;

    public $answer;

    public $title;

    public $maxVotes = 1;

    public $unlimitedVotes;

    public $useCustomInput;

    public function updatePollAnswer(): void
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'maxVotes' => 'required|integer|min:1',
            'unlimitedVotes' => 'required|boolean',
            'useCustomInput' => 'required|boolean',
        ]);

        try {
            $this->answer->update([
                'title' => $this->title,
                'max_votes' => $this->maxVotes,
                'unlimited_votes' => $this->unlimitedVotes,
                'use_custom_input' => $this->useCustomInput,
            ]);
        } catch (Exception $e) {
            Notification::make()
                ->title(__('messages.notifications.something_went_wrong'))
                ->danger()
                ->send();

            $this->dispatch('logger', ['type' => 'error', 'message' => $e->getMessage()]);

            return;
        }

        Notification::make()
            ->title(__('sites/poll.modals.update_answer.notifications.answer_updated'))
            ->success()
            ->send();

        $this->redirect(url()->previous(), navigate: true);

    }

    public function mount(): void
    {
        $this->answer = Poll::find($this->pollId)->pollAnswers()->find($this->answerId);

        if (!$this->answer) {
            $this->closeModal();

            return;
        }

        $this->title = $this->answer->title;
        $this->maxVotes = $this->answer->max_votes;
        $this->unlimitedVotes = (bool) $this->answer->unlimited_votes;
        $this->useCustomInput = (bool) $this->answer->use_custom_input;

    }

    public function render()
    {
        return view('livewire.components.modals.polls.update-poll-answer');
    }
}
