<?php

namespace Tests\Feature\Livewire\Components\Modals\Polls;

use App\Livewire\Components\Modals\Polls\AddPollVote;
use App\Models\Poll;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class AddPollVoteTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function renders_successfully()
    {
        $poll = Poll::create([
            'title' => 'Test Poll',
            'description' => 'Test Description',
            'admin_secret' => 'admin_secret',
            'view_secret' => 'view_secret',
            'end_date' => now()->addDays(7),
            'email' => 'test@local.host',
        ]);

        Livewire::test(AddPollVote::class, ['viewSecret' => $poll->view_secret])
            ->assertStatus(200);
    }

    /** @test */
    public function can_add_poll_vote()
    {
        $poll = Poll::create([
            'title' => 'Test Poll',
            'description' => 'Test Description',
            'admin_secret' => 'admin_secret',
            'view_secret' => 'view_secret',
            'end_date' => now()->addDays(7),
            'email' => 'test@local.host',
        ]);

        $pollAnswer = $poll->pollAnswers()->create([
            'title' => 'Answer 1',
            'max_votes' => 2,
            'unlimited_votes' => false,
        ]);

        Livewire::test(AddPollVote::class, ['viewSecret' => $poll->view_secret])
            ->set('name', 'Test User')
            ->set('pollAnswerId', $pollAnswer->id)
            ->call('addPollVote');

        $this->assertDatabaseHas('poll_votes', [
            'poll_id' => $poll->id,
            'name' => 'Test User',
        ]);
    }
}
