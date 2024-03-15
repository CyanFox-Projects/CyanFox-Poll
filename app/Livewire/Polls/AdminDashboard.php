<?php

namespace App\Livewire\Polls;

use App\Facades\PollManager;
use Exception;
use Filament\Notifications\Notification;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class AdminDashboard extends Component
{
    public $answers;

    public $adminSecret;

    public $publicLink;

    public $adminLink;

    #[Url]
    public $tab = 'answers';

    public $poll;

    public $title;

    public $description;

    public $email;

    public $endDate;

    #[On('addPollAnswer')]
    public function addPollAnswer($answer): void
    {
        try {
            $pollAnswer = $this->poll->pollAnswers()->create([
                'title' => $answer['title'],
                'max_votes' => $answer['maxVotes'],
                'unlimited_votes' => $answer['useUnlimitedVotes'],
                'custom_input' => $answer['useCustomInput'],
            ]);
            $this->answers[] = $pollAnswer;
        } catch (Exception $e) {
            Notification::make()
                ->title(__('messages.notifications.something_went_wrong'))
                ->danger()
                ->send();

            $this->dispatch('logger', ['type' => 'error', 'message' => $e->getMessage()]);

            return;
        }

        Notification::make()
            ->title(__('sites/poll.modals.add_answer.notifications.answer_added'))
            ->success()
            ->send();
    }

    public function deleteAnswer($answerIndex, $answerId): void
    {
        unset($this->answers[$answerIndex]);
        PollManager::getPollAnswersManager($this->poll)->deleteAnswer($answerId);
    }

    public function updatePoll(): void
    {
        $this->validate([
            'title' => 'required|max:255',
            'description' => 'nullable|max:255',
            'email' => 'nullable|email',
            'endDate' => 'required|date|after:today',
        ]);

        try {
            $this->poll->update([
                'title' => $this->title,
                'description' => $this->description,
                'email' => $this->email,
                'end_date' => $this->endDate,
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
            ->title(__('sites/poll.admin_dashboard.notifications.poll_updated'))
            ->success()
            ->send();

        $this->redirect(route('polls.admin', ['adminSecret' => $this->poll->admin_secret, 'tab' => $this->tab]), navigate: true);
    }

    public function deletePoll(): void
    {
        $this->dispatch('openModal', 'components.modals.polls.delete-poll', ['adminSecret' => $this->poll->admin_secret]);
    }

    public function mount(): void
    {
        if (!in_array($this->tab, ['answers', 'votes'])) {
            $this->tab = 'answers';
        }

        $this->poll = PollManager::findPollByAdminSecret($this->adminSecret);

        if (!$this->poll) {
            abort(404);
        }

        $this->title = $this->poll->title;
        $this->description = $this->poll->description;
        $this->email = $this->poll->email;
        $this->endDate = date('Y-m-d', strtotime($this->poll->end_date));
        $this->answers = $this->poll->pollAnswers;

        $this->publicLink = route('polls.view', ['viewSecret' => $this->poll->view_secret]);
        $this->adminLink = route('polls.admin', ['adminSecret' => $this->poll->admin_secret]);
    }

    public function render()
    {
        return view('livewire.polls.admin-dashboard')
            ->layout('components.layouts.app', ['title' => __('sites/poll.admin_dashboard.tab_title', ['title' => $this->poll->title])]);
    }
}
