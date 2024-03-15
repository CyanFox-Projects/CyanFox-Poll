<?php

namespace App\Livewire\Components\Modals\Polls;

use App\Facades\PollManager;
use Exception;
use Filament\Notifications\Notification;
use LivewireUI\Modal\ModalComponent;

class AddPollVote extends ModalComponent
{
    public $poll;

    public $pollAnswers;

    public $pollAnswerId;

    public $viewSecret;

    public $selectedPollAnswers;

    public $pollVoteCustomInput;

    public $useCustomInput;

    public $name;

    public function addPollVote($addAnother = false): void
    {
        $this->validate([
            'name' => 'required',
            'pollAnswerId' => 'required',
        ]);

        $pollAnswer = $this->poll->pollAnswers()->find($this->pollAnswerId);
        if ($pollAnswer->custom_input && $this->pollVoteCustomInput == null) {
            $this->useCustomInput = true;

            return;
        }

        $this->selectedPollAnswers[] = [
            'poll_answer_id' => $this->pollAnswerId,
            'custom_input' => $this->pollVoteCustomInput,
        ];

        if ($addAnother) {
            $this->pollAnswers = $this->pollAnswers->filter(function ($answer) {
                return $answer['id'] != $this->pollAnswerId;
            });
            $this->pollAnswerId = null;
            $this->pollVoteCustomInput = null;
            $this->useCustomInput = false;

            return;
        }

        try {
            PollManager::getPollVotesManager($this->poll)->addVote($this->name, $this->selectedPollAnswers);
        } catch (Exception $e) {
            Notification::make()
                ->title(__('messages.notifications.something_went_wrong'))
                ->danger()
                ->send();

            $this->dispatch('logger', ['type' => 'error', 'message' => $e->getMessage()]);

            return;
        }

        Notification::make()
            ->title(__('sites/poll.vote.notifications.vote_added'))
            ->success()
            ->send();

        $this->redirect(route('polls.view', $this->poll->view_secret));
    }

    public function mount(): void
    {
        $this->poll = PollManager::findPollByViewSecret($this->viewSecret);

        if (!$this->poll) {
            $this->closeModal();

            return;
        }

        $this->pollAnswers = $this->poll->pollAnswers()->get();

        $this->pollAnswers = $this->pollAnswers->map(function ($answer) {
            if ($answer->unlimited_votes) {
                return [
                    'id' => $answer->id,
                    'name' => $answer->title,
                ];
            }
            if ($answer->max_votes > $answer->votes) {
                return [
                    'id' => $answer->id,
                    'name' => $answer->title.' ('.$answer->votes.'/'.$answer->max_votes.' '.__('sites/poll.vote.votes').')',
                ];
            }

            return [
                'id' => $answer->id,
                'name' => $answer->title.' ('.$answer->votes.'/'.$answer->max_votes.' '.__('sites/poll.vote.votes').')',
                'disabled' => true,
            ];
        });
    }

    public function render()
    {
        return view('livewire.components.modals.polls.add-poll-vote');
    }
}
