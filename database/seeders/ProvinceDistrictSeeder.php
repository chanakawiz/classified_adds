<?php

namespace Database\Seeders;

use App\Models\District;
use App\Models\Province;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProvinceDistrictSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            'Western' => ['Colombo', 'Gampaha', 'Kalutara'],
            'Central' => ['Kandy', 'Matale', 'Nuwara Eliya'],
            'Southern' => ['Galle', 'Matara', 'Hambantota'],
            'Northern' => ['Jaffna', 'Kilinochchi', 'Mannar', 'Mullaitivu', 'Vavuniya'],
            'Eastern' => ['Trincomalee', 'Batticaloa', 'Ampara'],
            'North Western' => ['Kurunegala', 'Puttalam'],
            'North Central' => ['Anuradhapura', 'Polonnaruwa'],
            'Uva' => ['Badulla', 'Monaragala'],
            'Sabaragamuwa' => ['Ratnapura', 'Kegalle'],
        ];

        foreach ($data as $provinceName => $districts) {
            $province = Province::updateOrCreate(
                ['slug' => Str::slug($provinceName)],
                ['name' => $provinceName]
            );

            foreach ($districts as $districtName) {
                District::updateOrCreate(
                    ['slug' => Str::slug($provinceName.'-'.$districtName)],
                    [
                        'province_id' => $province->id,
                        'name' => $districtName,
                    ]
                );
            }
        }
    }
}


