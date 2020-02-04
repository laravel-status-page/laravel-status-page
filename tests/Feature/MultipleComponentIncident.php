<?php

namespace Tests\Feature;

use App\Models\Component;
use App\Models\User;
use App\Models\Incident;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MultipleComponentIncident extends TestCase
{
    private $incident;

    public function setUp(): void
    {
        parent::setUp();
        $this->incident = factory(Incident::class)->create();

        factory(Component::class, 2)
            ->create()
            ->each(function ($component) {
                $this->incident->components()->save($component);
            });
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
        $this->assertIsInt(User::find($this->incident->user_id)->id);
    }

    /** @test */
    public function has_occurred_time()
    {
        $this->assertTrue(!empty($this->incident->occurred_at));
    }

    /** @test */
    public function has_components()
    {
        /**
         * Grab components as collection for testing.
         */
        $components = $this->incident->components;

        $this->assertTrue($components->count() > 1);
        $this->assertIsInt($components->first()->id);
        $this->assertTrue(class_basename($components->first()) == 'Component');
    }
}
