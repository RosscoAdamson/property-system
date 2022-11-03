<?php

namespace Database\Seeders;

use App\Models\Property;
use App\Services\PropertyApi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $properties = PropertyApi::get()->json()['data'];

        foreach ($properties as $property) {
            Property::firstOrCreate(
                ['address' => $property['address']],
                [
                    'county' => $property['county'],
                    'country' => $property['country'],
                    'town' => $property['town'],
                    'description' => $property['description'],
                    'image_full' => $property['image_full'],
                    'image_thumbnail' => $property['image_thumbnail'],
                    'latitude' => $property['latitude'],
                    'longitude' => $property['longitude'],
                    'num_bedrooms' => $property['num_bedrooms'],
                    'num_bathrooms' => $property['num_bathrooms'],
                    'price' => $property['price'],
                    'type' => $property['type'],
                    'property_type' => $property['property_type']['title']
                ]
            );
        }
    }
}
