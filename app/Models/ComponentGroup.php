<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComponentGroup extends BaseModel
{
    public function components()
    {
        return $this->hasMany(Component::class, 'component_group_id');
    }
}
