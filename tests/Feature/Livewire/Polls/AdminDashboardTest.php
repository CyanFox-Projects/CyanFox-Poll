<?php

namespace Tests\Feature\Livewire\Polls;

use App\Livewire\Polls\AdminDashboard;
use App\Models\Poll;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class AdminDashboardTest extends TestCase
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
        Livewire::test(AdminDashboard::class, ['adminSecret' => $poll->admin_secret])
            ->assertStatus(200);
    }

    /** @test */
    public function can_update_poll()
    {
        $poll = Poll::create([
            'title' => 'Test Poll',
            'description' => 'Test Description',
            'admin_secret' => 'admin_secret',
            'view_secret' => 'view_secret',
            'end_date' => now()->addDays(7),
            'email' => 'test@local.host',
        ]);

        Livewire::test(AdminDashboard::class, ['adminSecret' => $poll->admin_secret])
            ->set('title', 'Test Poll 1')
            ->set('description', 'Test Description 1')
            ->set('email', 'test1@local.host')
            ->set('endDate', now()->addDays(14))
            ->call('updatePoll');

        $this->assertDatabaseHas('polls', [
            'title' => 'Test Poll 1',
            'description' => 'Test Description 1',
            'email' => 'test1@local.host',
        ]);
    }
}
