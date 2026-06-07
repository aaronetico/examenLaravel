<?php

namespace Database\Seeders;

use App\Models\CarVersion;
use App\Models\Part;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RealPartsSeeder extends Seeder
{
    private array $localImages = [
        'turbocompresor.jpg' => ['turbo', 'turbocompresor'],
        'ciguenal.jpg' => ['ciguenal', 'cigüeñal', 'cigueñal'],
        'arbolevas.jpg' => ['arbol', 'árbol', 'levas', 'arbolevas'],
        'bomba.jpg' => ['bomba'],
        'colector.jpg' => ['colector'],
    ];

    private function loadCsvColumn(string $filename, string $column): array
    {
        $path = database_path("data/{$filename}");
        if (! is_file($path)) {
            return [];
        }

        $rows = array_map('str_getcsv', file($path));
        $header = array_shift($rows);
        $index = array_search($column, $header, true);

        if ($index === false) {
            return [];
        }

        return array_values(array_filter(array_map(
            fn (array $row) => trim($row[$index] ?? ''),
            $rows
        )));
    }

    private function loadDescriptionMap(): array
    {
        $path = database_path('data/description_parts.csv');
        if (! is_file($path)) {
            return [];
        }

        $rows = array_map('str_getcsv', file($path));
        $header = array_shift($rows);
        $nameIndex = array_search('name', $header, true);
        $descIndex = array_search('description', $header, true);

        if ($nameIndex === false || $descIndex === false) {
            return [];
        }

        $map = [];
        foreach ($rows as $row) {
            $name = trim($row[$nameIndex] ?? '');
            $description = trim($row[$descIndex] ?? '');
            if ($name !== '' && $description !== '') {
                $map[mb_strtolower($name)] = $description;
            }
        }

        return $map;
    }

    private function descriptionForName(string $name, array $descriptionMap, array $descriptions): string
    {
        $key = mb_strtolower($name);
        if (isset($descriptionMap[$key])) {
            return $descriptionMap[$key];
        }

        $normalizedName = mb_strtolower($name);
        foreach ($descriptionMap as $descName => $description) {
            $words = preg_split('/\s+/', $descName) ?: [];
            foreach ($words as $word) {
                if (strlen($word) >= 5 && str_contains($normalizedName, $word)) {
                    return $description;
                }
            }
        }

        return $descriptions[array_rand($descriptions)] ?? 'Pieza mecánica de recambio para motor.';
    }

    private function imageForName(string $name): string
    {
        $normalized = mb_strtolower($name);

        foreach ($this->localImages as $file => $keywords) {
            foreach ($keywords as $keyword) {
                if (str_contains($normalized, mb_strtolower($keyword))) {
                    return "/assets/parts/{$file}";
                }
            }
        }

        $files = array_keys($this->localImages);

        return '/assets/parts/' . $files[array_rand($files)];
    }

    public function run(): void
    {
        Part::truncate();

        $names = $this->loadCsvColumn('name_parts.csv', 'name');
        $descriptions = $this->loadCsvColumn('description_parts.csv', 'description');
        $descriptionMap = $this->loadDescriptionMap();

        if ($names === []) {
            $names = ['Pieza mecánica genérica'];
        }

        $partsPerVersion = 2;

        CarVersion::with(['carYear.carModel.brand'])->orderBy('id')->each(function (CarVersion $version) use ($names, $descriptions, $descriptionMap, $partsPerVersion) {
            $pickedNames = (array) array_rand(array_flip($names), min($partsPerVersion, count($names)));

            if (! is_array($pickedNames)) {
                $pickedNames = [$pickedNames];
            }

            foreach ($pickedNames as $partName) {
                Part::create([
                    'car_version_id' => $version->id,
                    'name' => $partName,
                    'sku' => strtoupper(Str::random(3) . '-' . random_int(10000, 99999)),
                    'description' => $this->descriptionForName($partName, $descriptionMap, $descriptions),
                    'image_url' => $this->imageForName($partName),
                    'price' => round(random_int(1500, 150000) / 100, 2),
                    'stock' => random_int(0, 40),
                    'agotado' => false,
                ]);
            }
        });

        Part::query()->each(function (Part $part) {
            $part->update(['agotado' => $part->stock <= 0]);
        });
    }
}
