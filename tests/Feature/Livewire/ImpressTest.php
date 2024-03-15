<?php

namespace Tests\Feature\Livewire;

use App\Livewire\Impress;
use Livewire\Livewire;
use Tests\TestCase;

class ImpressTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(Impress::class)
            ->assertStatus(200);
    }
}
