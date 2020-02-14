<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Incident;
use App\Models\User;
use App\Models\Component;

class SingleComponentIncident extends TestCase
{
    private $incident;

    public function setUp(): void
    {
        parent::setUp();
        $this->incident = factory(Incident::class)->create();

        $component = factory(Component::class)->create();

        $this->incident->components()->save($component);
    }

    /** @test */
    public function has_name()
    {
        $this->assertIsString($this->incident->name);
    }

    /** @test */
    public function has_status()
    {
        $this->assertIsInt($this->incident->status);
        $this->assertTrue(
            in_array($this->incident->status, array_keys(config('laravel-status-page.incident-statuses')))
        );
    }

    /** @test */
    public function has_owner()
    {
        $this->assertIsInt($this->incident->user_id);
        $this->assertInstanceOf(User::class, User::find($this->incident->user_id));
    }

    /** @test */
    public function has_occurred_time()
    {
        $this->assertTrue(!empty($this->incident->occurred_at));
    }

    /** @test */
    public function has_component()
    {
        /**
         * Grab components as collection for testing.
         */
        $components = $this->incident->components;

        $this->assertTrue($components->count() > 0);
        $this->assertIsInt($components->first()->id);
        $this->assertInstanceOf(Component::class, $components->first());
    }
}
