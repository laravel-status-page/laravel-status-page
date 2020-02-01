<?php

namespace Tests\Feature;

use App\Models\Component;
use App\Models\ComponentGroup;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ComponentTest extends TestCase
{
    private $component;

    public function setUp(): void
    {
        parent::setUp();
        $this->component = factory(Component::class)->create();
    }

    /** @test */
    public function it_has_a_name()
    {
        $this->assertIsString($this->component->name);
    }

    /** @test */
    public function it_has_a_status()
    {
        $this->assertIsInt($this->component->status);
        $this->assertTrue(
            in_array($this->component->status, array_keys(config('laravel-status-page.statuses')))
        );
    }

    /** @test */
    public function it_has_a_component_group()
    {
        $this->assertInstanceOf(ComponentGroup::class, $this->component->group);
    }
}
