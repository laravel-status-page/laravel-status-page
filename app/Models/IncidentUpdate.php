<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Incident;
use App\Models\User;

class IncidentUpdate extends Model
{

    /**
     * Casted attributes.
     *
     * @var string[]
     */
    protected $casts = [
        'user_id' => 'int',
        'status' => 'int',
    ];

    /**
     * Fillable attributes.
     *
     * @var string[]
     */
    protected $fillable = [
        'incident_id',
        'user_id',
        'name',
        'status',
        'message'
    ];

    /**
     * Fetch user that created update.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Fetch incident being updated.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function incident()
    {
        return $this->belongsTo(Incident::class);
    }
}
