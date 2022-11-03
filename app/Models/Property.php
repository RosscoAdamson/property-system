<?php

namespace App\Models;

use App\Events\PropertyUpdated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'county',
        'country',
        'town',
        'description',
        'address',
        'image_full',
        'image_thumbnail',
        'latitude',
        'longitude',
        'num_bedrooms',
        'num_bathrooms',
        'price',
        'type',
        'property_type'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'num_bedrooms' => 'integer',
        'num_bathrooms' => 'integer',
        'price' => 'integer'
    ];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        // 'updated' => PropertyUpdated::class,
    ];

    public function agents()
    {
        return $this->belongsToMany(Agent::class)
            ->using(AgentProperty::class)
            ->withPivot(['can_conduct_viewings', 'can_sell_property']);
    }
}
