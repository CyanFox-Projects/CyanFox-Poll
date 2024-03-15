<?php

namespace App\Livewire\Polls;

use App\Models\Poll;
use Exception;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\On;
use Livewire\Component;

class CreatePoll extends Component
{
    public array $answers = [];

    public $title;

    public $description;

    public $email;

    public $endDate;

    public $captchaImg;

    public $captcha;

    #[On('addPollAnswer')]
    public function addPollAnswer($answer): void
    {
        try {
            $this->answers[] = $answer;
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

    public function deleteAnswer($answerIndex): void
    {
        unset($this->answers[$answerIndex]);
        $this->answers = array_values($this->answers);
    }

    public function createPoll(): void
    {
        $this->validate([
            'title' => 'required|max:255',
            'description' => 'nullable|max:255',
            'email' => 'nullable|email',
            'endDate' => 'required|date|after:today',
        ]);

        if (config('captcha.disabled') === false) {
            $validator = Validator::make(['captcha' => $this->captcha], ['captcha' => 'required|captcha']);

            if ($validator->fails()) {
                $this->captchaImg = captcha_src();
                throw ValidationException::withMessages([
                    'captcha' => __('validation.custom.invalid_captcha'),
                ]);
            }
        }

        try {
            $poll = Poll::create([
                'title' => $this->title,
                'description' => $this->description,
                'email' => $this->email,
                'admin_secret' => Str::random(),
                'view_secret' => Str::random(),
                'end_date' => $this->endDate,
            ]);

            foreach ($this->answers as $answer) {
                $poll->pollAnswers()->create([
                    'title' => $answer['title'],
                    'max_votes' => $answer['maxVotes'],
                    'unlimited_votes' => $answer['useUnlimitedVotes'],
                    'custom_input' => $answer['useCustomInput'],
                ]);
            }
        } catch (Exception $e) {
            Notification::make()
                ->title(__('messages.notifications.something_went_wrong'))
                ->danger()
                ->send();

            $this->dispatch('logger', ['type' => 'error', 'message' => $e->getMessage()]);

            return;
        }

        Notification::make()
            ->title(__('sites/poll.create_poll.notifications.poll_created'))
            ->success()
            ->send();

        $this->redirect(route('polls.admin', ['adminSecret' => $poll->admin_secret]), navigate: true);
    }

    public function mount(): void
    {
        $this->endDate = now()->addDays(30)->format('Y-d-m');
        $this->captchaImg = captcha_src();
    }

    public function render()
    {
        return view('livewire.polls.create-poll')
            ->layout('components.layouts.app', ['title' => __('sites/poll.create_poll.tab_title')]);
    }
}
