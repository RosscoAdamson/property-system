<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class AgentProperty extends Pivot
{
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'can_conduct_viewings',
        'can_sell_property'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'can_conduct_viewings' => 'boolean',
        'can_sell_property' => 'boolean'
    ];
}
