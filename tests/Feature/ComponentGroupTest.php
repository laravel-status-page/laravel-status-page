<?php

namespace Tests\Feature;

use App\Models\Component;
use App\Models\ComponentGroup;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ComponentGroupTest extends TestCase
{
    private $componentGroup;

    public function setUp(): void
    {
        parent::setUp();
        $this->componentGroup = factory(ComponentGroup::class)->create();
        factory(Component::class, 2)->create([
            'component_group_id' => $this->componentGroup
        ]);
    }

    /** @test */
    public function it_has_a_name()
    {
        $this->assertIsString($this->componentGroup->name);
    }

    /** @test */
    public function it_has_can_be_visible()
    {
        $this->assertIsBool(
            $this->componentGroup->visible
        );
    }

    /** @test */
    public function it_has_many_components()
    {
        $this->assertCount(2, $this->componentGroup->components);
        $this->assertInstanceOf(Component::class, $this->componentGroup->components->first());
    }
}
