<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Component extends BaseModel
{
    public function group()
    {
        return $this->belongsTo(ComponentGroup::class, 'component_group_id');
    }
}
