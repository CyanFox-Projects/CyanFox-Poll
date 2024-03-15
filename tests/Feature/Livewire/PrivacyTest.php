<?php

namespace Tests\Feature\Livewire;

use App\Livewire\Privacy;
use Livewire\Livewire;
use Tests\TestCase;

class PrivacyTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(Privacy::class)
            ->assertStatus(200);
    }
}
