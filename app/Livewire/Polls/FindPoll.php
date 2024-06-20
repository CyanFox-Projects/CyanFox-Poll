<?php

namespace App\Livewire\Polls;

use App\Models\Poll;
use Exception;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class FindPoll extends Component
{
    public $captchaImg;

    public $captcha;

    public $email;

    public $polls;

    public function searchPoll(): void
    {
        $this->validate([
            'email' => 'required|email',
        ]);

        if (config('captcha.disable') === false && config('app.env') !== 'testing') {
            $validator = Validator::make(['captcha' => $this->captcha], ['captcha' => 'required|captcha']);

            if ($validator->fails()) {
                $this->captchaImg = captcha_src();
                throw ValidationException::withMessages([
                    'captcha' => __('validation.custom.invalid_captcha'),
                ]);
            }
        }

        try {
            $this->polls = Poll::where('email', $this->email)->get();

            if ($this->polls->isEmpty()) {
                $this->addError('email', __('sites/poll.find_poll.no_polls_found'));
            }
        } catch (Exception $e) {
            Notification::make()
                ->title(__('messages.notifications.something_went_wrong'))
                ->danger()
                ->send();

            $this->dispatch('logger', ['type' => 'error', 'message' => $e->getMessage()]);

            return;
        }
    }

    public function mount(): void
    {
        $this->captchaImg = captcha_src();
    }

    public function render()
    {
        return view('livewire.polls.find-poll')
            ->layout('components.layouts.app', ['title' => __('sites/poll.find_poll.tab_title')]);
    }
}
