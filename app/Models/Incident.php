<?php

namespace App\Models;

use App\Models\Component;
use App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    protected $casts = [
        'user_id' => 'int',
        'status' => 'int',
        'occurred_at' => 'datetime',
    ];

    protected $fillable = [
        'user_id',
        'name',
        'status',
        'occurred_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function components()
    {
        return $this->belongsToMany(Component::class);
    }
}
