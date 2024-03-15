<?php

namespace Tests\Feature\Livewire\Components\Modals\Polls;

use App\Livewire\Components\Modals\Polls\AddPollAnswer;
use App\Livewire\Polls\AdminDashboard;
use App\Models\Poll;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class AddPollAnswerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function renders_successfully()
    {
        Livewire::test(AddPollAnswer::class)
            ->assertStatus(200);
    }

    /** @test */
    public function can_add_poll_answer()
    {
        $poll = Poll::create([
            'title' => 'Test Poll',
            'description' => 'Test Description',
            'admin_secret' => 'admin_secret',
            'view_secret' => 'view_secret',
            'end_date' => now()->addDays(7),
            'email' => 'test@local.host',
        ]);

        $answer = [
            'title' => 'New Answer',
            'maxVotes' => 5,
            'useUnlimitedVotes' => false,
            'useCustomInput' => true,
        ];

        Livewire::test(AdminDashboard::class, ['adminSecret' => $poll->admin_secret])
            ->set('poll', $poll)
            ->call('addPollAnswer', $answer);

        $this->assertDatabaseHas('poll_answers', [
            'title' => 'New Answer',
            'max_votes' => 5,
            'unlimited_votes' => false,
            'custom_input' => true,
        ]);
    }
}
