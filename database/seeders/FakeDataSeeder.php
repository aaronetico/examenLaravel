<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CarVersion;
use App\Models\Part;

class FakeDataSeeder extends Seeder
{
    private array $imageByKeyword = [
        'freno' => 'https://upload.wikimedia.org/wikipedia/commons/0/0e/Disc_brake.jpg',
        'brake' => 'https://upload.wikimedia.org/wikipedia/commons/0/0e/Disc_brake.jpg',
        'aceite' => 'https://upload.wikimedia.org/wikipedia/commons/8/8c/Engine_oil_filter.JPG',
        'oil' => 'https://upload.wikimedia.org/wikipedia/commons/8/8c/Engine_oil_filter.JPG',
        'amortiguador' => 'https://upload.wikimedia.org/wikipedia/commons/5/5d/Shock_absorber.jpg',
        'suspension' => 'https://upload.wikimedia.org/wikipedia/commons/5/5d/Shock_absorber.jpg',
        'direccion' => 'https://upload.wikimedia.org/wikipedia/commons/1/1f/Tie_rod_end.jpg',
        'tie' => 'https://upload.wikimedia.org/wikipedia/commons/1/1f/Tie_rod_end.jpg',
        'correa' => 'https://upload.wikimedia.org/wikipedia/commons/7/73/Timing_belt.jpg',
        'belt' => 'https://upload.wikimedia.org/wikipedia/commons/7/73/Timing_belt.jpg',
    ];

    private function imageForPart(string $name): string
    {
        $normalized = mb_strtolower($name);
        foreach ($this->imageByKeyword as $keyword => $url) {
            if (str_contains($normalized, $keyword)) {
                return $url;
            }
        }

        return 'https://upload.wikimedia.org/wikipedia/commons/8/8c/Engine_oil_filter.JPG';
    }

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
                ])->each(function (Part $part) {
                    $part->update([
                        'image_url' => $this->imageForPart($part->name),
                    ]);
                });
        });


    }
}
