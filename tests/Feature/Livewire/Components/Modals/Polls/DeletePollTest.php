<?php

namespace Tests\Feature\Livewire\Components\Modals\Polls;

use App\Livewire\Components\Modals\Polls\DeletePoll;
use App\Models\Poll;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class DeletePollTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function renders_successfully()
    {
        Livewire::test(DeletePoll::class)
            ->assertStatus(200);
    }

    /** @test */
    public function can_delete_poll()
    {
        $poll = Poll::create([
            'title' => 'Test Poll',
            'description' => 'Test Description',
            'admin_secret' => 'admin_secret',
            'view_secret' => 'view_secret',
            'end_date' => now()->addDays(7),
            'email' => 'test@local.host',
        ]);

        Livewire::test(DeletePoll::class)
            ->set('adminSecret', $poll->admin_secret)
            ->call('deletePoll');

        $this->assertDatabaseMissing('polls', [
            'title' => 'Test Poll',
            'description' => 'Test Description',
            'admin_secret' => 'admin_secret',
            'view_secret' => 'view_secret',
            'end_date' => now()->addDays(7),
            'email' => 'test@local.host',
        ]);
    }
}
