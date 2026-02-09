<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CarVersion;
use App\Models\Part;

class FakeDataSeeder extends Seeder
{
    public function run(): void
    {
        // Si quieres limpiar SOLO parts (opcional)
        Part::truncate();

        $PARTS_PER_VERSION = 2;

        CarVersion::all()->each(function ($version) use ($PARTS_PER_VERSION) {
            Part::factory()
                ->count($PARTS_PER_VERSION)
                ->create([
                    'car_version_id' => $version->id,
                ]);
        });


    }
}
