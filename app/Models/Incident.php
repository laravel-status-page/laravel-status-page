<?php

namespace App\Models;

use App\Models\Component;
use App\Models\User;
use App\Models\IncidentUpdate;

use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    /**
     * Casted attributes.
     *
     * @var string[]
     */
    protected $casts = [
        'user_id' => 'int',
        'status' => 'int',
        'occurred_at' => 'datetime',
    ];

    /**
     * Fillable attributes.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'name',
        'status',
        'occurred_at'
    ];

    /**
     * Fetch user that created incident.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Fetch components associated with the incident.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function components()
    {
        return $this->belongsToMany(Component::class);
    }

    /**
     * Fetch any updates made to the incident after creation.
     *
     * @return \Illuminate\Database\Eloquent\Relationsh\HasMany
     */
    public function updates()
    {
        return $this->hasMany(IncidentUpdate::class);
    }

    /**
     * Define delete function to remove associated entries.
     */
    public function delete()
    {
        foreach ($this->updates()->get() as $update) {
            $update->delete();
        }

        parent::delete();
    }
}
