<?php

namespace Tests\Feature\Livewire\Polls;

use App\Livewire\Polls\FindPoll;
use App\Models\Poll;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class FindPollTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function renders_successfully()
    {
        Livewire::test(FindPoll::class)
            ->assertStatus(200);
    }

    /** @test */
    public function can_find_poll()
    {
        Poll::create([
            'title' => 'Test Poll',
            'description' => 'Test Description',
            'admin_secret' => 'admin_secret',
            'view_secret' => 'view_secret',
            'end_date' => now()->addDays(7),
            'email' => 'test@local.host',
        ]);

        Livewire::test(FindPoll::class)
            ->set('email', 'test@local.host')
            ->call('searchPoll')
            ->assertSet('polls', Poll::where('email', 'test@local.host')->get());
    }
}
