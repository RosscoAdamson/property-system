<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'address',
        'phone_numbers'
    ];

    protected $casts = [
        'phone_numbers' => 'array'
    ];

    public function properties()
    {
        return $this->belongsToMany(Property::class)
            ->using(AgentProperty::class)
            ->withPivot(['can_conduct_viewings', 'can_sell_property']);
    }

    public function getTotalPriceAttribute()
    {
        return $this->properties->sum('price');
    }
}
