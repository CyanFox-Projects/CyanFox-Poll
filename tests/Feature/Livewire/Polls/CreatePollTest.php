<?php

namespace Tests\Feature\Livewire\Polls;

use App\Livewire\Polls\CreatePoll;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class CreatePollTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function renders_successfully()
    {
        Livewire::test(CreatePoll::class)
            ->assertStatus(200);
    }

    /** @test */
    public function can_create_poll()
    {
        Livewire::test(CreatePoll::class)
            ->set('title', 'Test Poll')
            ->set('description', 'Test Description')
            ->set('endDate', now()->addDays(7)->format('Y-m-d'))
            ->set('email', 'test@local.host')
            ->call('createPoll');

        $this->assertDatabaseHas('polls', [
            'title' => 'Test Poll',
            'description' => 'Test Description',
            'end_date' => now()->addDays(7)->format('Y-m-d'),
            'email' => 'test@local.host',
        ]);
    }
}
