<?php

namespace App\Livewire\Components\Modals\Polls;

use App\Facades\PollManager;
use Exception;
use Filament\Notifications\Notification;
use LivewireUI\Modal\ModalComponent;

class DeletePoll extends ModalComponent
{
    public $adminSecret;

    public function deletePoll(): void
    {
        try {
            $poll = PollManager::findPollByAdminSecret($this->adminSecret);
            $poll->delete();
        } catch (Exception $e) {
            Notification::make()
                ->title(__('messages.notifications.something_went_wrong'))
                ->danger()
                ->send();

            $this->dispatch('logger', ['type' => 'error', 'message' => $e->getMessage()]);

            return;
        }

        Notification::make()
            ->title(__('sites/poll.admin_dashboard.notifications.poll_deleted'))
            ->success()
            ->send();
        $this->redirect(route('home'));
    }

    public function render()
    {
        return view('livewire.components.modals.polls.delete-poll');
    }
}
