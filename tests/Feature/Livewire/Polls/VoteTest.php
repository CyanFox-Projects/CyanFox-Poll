<?php

namespace Tests\Feature\Livewire\Polls;

use App\Livewire\Polls\Vote;
use App\Models\Poll;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class VoteTest extends TestCase
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

        Livewire::test(Vote::class, ['viewSecret' => $poll->view_secret])
            ->assertStatus(200);
    }
}
