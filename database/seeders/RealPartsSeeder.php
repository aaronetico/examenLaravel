<?php

namespace Database\Seeders;

use App\Models\CarVersion;
use App\Models\Part;
use Illuminate\Database\Seeder;

class RealPartsSeeder extends Seeder
{
    private function hondaAccordParts(): array
    {
        return [
            [
                'name' => 'Honda Pistón (STD 81.00mm) (PCT/B16B) - 13010-PCT-000',
                'sku' => '13010-PCT-000',
                'image_url' => 'https://www.akr-performance.es/media/products/piezas-de-motor-civic-3-puertas-hatchback-1998-2001-16-tipo-r-jdm_honda-piston-std-8100mm-pctb16b-13010-pct-000.jpg',
                'price' => 189.90,
                'stock' => 12,
                'description' => 'Pistón Accord EK9 PCTX (1 pieza). Diseñado para motores atmosféricos de alto rendimiento de la serie B. Construcción de fundición de alta presión con faldas recubiertas de molibdeno seco. Orificios de aceite adicionales en ranuras de segmentos y pasajes extra en levas de bulones. Variante PCTX con la cúpula más alta de pistón Tipo R OEM. Se suministra con bulón nuevo. Anillos no incluidos. Relaciones de compresión estimadas: B16A 11,1 | B17A 11,4 | B18C GSR 11,8 | B18C Type R/B16 11,6.',
            ],
            [
                'name' => 'Bloque de culata Honda Accord K24 2.4 i-VTEC',
                'sku' => 'HON-K24-HEAD',
                'image_url' => 'https://m.media-amazon.com/images/I/71AxBphKhhL._AC_SX679_.jpg',
                'price' => 649.00,
                'stock' => 4,
                'description' => 'Culata completa para motores Honda K24 2.4 16V (Accord, CR-V). Cámara de combustión OEM, compatible con culata estándar i-VTEC. Aplicaciones: Accord 2.4, CR-V K24. Instalación directa tipo OEM con juego de juntas recomendado. Revisión de planitud y asientos de válvula recomendada antes del montaje.',
            ],
            [
                'name' => 'Bielas forjadas Carrillo en H Honda Accord y CR-V K24',
                'sku' => 'CARR-K24-H',
                'image_url' => 'https://www.piratamotor.com/server/Portal_0035731_0055842/img/products/bielas-forjadas-carrillo-en-h-honda-accord-y-cr-v-k24_9335093_xxl.jpg',
                'price' => 899.00,
                'stock' => 6,
                'description' => 'Bielas forjadas Carrillo en H para Honda Accord y CR-V 2.4 16V. Código de motor K24. Acero 4340, tornillos 3/8 WMC or CARR. Longitud 152 mm. Diámetro cabeza 51,003 mm. Ancho cabeza 19,86 mm. Diámetro pie 22 mm. Ancho pie 19,81 mm. Peso 547 gramos.',
            ],
        ];
    }

    private function partsByBrand(string $brand): array
    {
        return match ($brand) {
            'Honda' => [
                [
                    'name' => 'Kit distribución Honda i-VTEC',
                    'sku' => 'HON-TB-KIT',
                    'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/7/73/Timing_belt.jpg',
                    'price' => 124.50,
                    'stock' => 18,
                    'description' => 'Kit de correa de distribución OEM equivalente para motores Honda i-VTEC. Incluye tensor y polea guía.',
                ],
                [
                    'name' => 'Filtro de aceite Honda OEM',
                    'sku' => 'HON-OIL-F',
                    'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/8/8c/Engine_oil_filter.JPG',
                    'price' => 14.90,
                    'stock' => 45,
                    'description' => 'Filtro de aceite de alta filtración para motores Honda gasolina. Presión de apertura calibrada de fábrica.',
                ],
            ],
            'Toyota' => [
                [
                    'name' => 'Pastillas freno TRW Toyota Corolla',
                    'sku' => 'TOY-BRK-PAD',
                    'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/0/0e/Disc_brake.jpg',
                    'price' => 59.90,
                    'stock' => 22,
                    'description' => 'Juego de pastillas cerámicas delanteras para Toyota Corolla/Camry. Bajo polvo y ruido reducido.',
                ],
                [
                    'name' => 'Amortiguador KYB Excel-G Toyota',
                    'sku' => 'TOY-SHOCK',
                    'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/5/5d/Shock_absorber.jpg',
                    'price' => 89.00,
                    'stock' => 14,
                    'description' => 'Amortiguador gas a presión KYB Excel-G. Respuesta estable y durabilidad para uso diario.',
                ],
            ],
            'Nissan' => [
                [
                    'name' => 'Turbo Garrett GT2860RS Nissan SR20',
                    'sku' => 'NIS-TUR-GT28',
                    'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/4/4f/Turbocharger_cutaway.jpg',
                    'price' => 1299.00,
                    'stock' => 3,
                    'description' => 'Turbocompresor ball bearing para preparaciones SR20/SR22. Ideal para GT-R, 240SX y plataformas Nissan deportivas.',
                ],
                [
                    'name' => 'Inyectores Denso Nissan 440cc',
                    'sku' => 'NIS-INJ-440',
                    'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/3/3a/Fuel_Injector.jpg',
                    'price' => 320.00,
                    'stock' => 8,
                    'description' => 'Inyectores de alto caudal Denso para motores Nissan turbo. Flujo lineal y excelente atomización.',
                ],
            ],
            'Mazda' => [
                [
                    'name' => 'Rotor apex Mazda 13B REW',
                    'sku' => 'MAZ-13B-ROT',
                    'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/6/6d/Wankel_engine_rotor.jpg',
                    'price' => 459.00,
                    'stock' => 5,
                    'description' => 'Rotor apex para motor rotativo Mazda 13B. Material reforzado para aplicaciones RX-7 y preparación.',
                ],
                [
                    'name' => 'Kit embrague Exedy Mazda MX-5',
                    'sku' => 'MAZ-MX5-CLT',
                    'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/9/9a/Clutch_disc.jpg',
                    'price' => 289.00,
                    'stock' => 7,
                    'description' => 'Kit de embrague orgánico Exedy para Mazda MX-5 NA/NB/NBFL. Pedal suave y agarre progresivo.',
                ],
            ],
            'Subaru' => [
                [
                    'name' => 'Junta culata MLS Subaru EJ25',
                    'sku' => 'SUB-EJ25-HG',
                    'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/1/1a/Head_gasket.jpg',
                    'price' => 189.00,
                    'stock' => 11,
                    'description' => 'Junta de culata multi capa de acero para Subaru EJ25 turbo. Impreza WRX/STI y Forester XT.',
                ],
                [
                    'name' => 'Turbo IHI VF34 Subaru WRX',
                    'sku' => 'SUB-VF34',
                    'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/4/4f/Turbocharger_cutaway.jpg',
                    'price' => 980.00,
                    'stock' => 4,
                    'description' => 'Turbocompresor IHI VF34 original spec para Subaru WRX STI. Respuesta rápida en media-alta.',
                ],
            ],
            default => [
                [
                    'name' => 'Kit correa auxiliar japonés OEM',
                    'sku' => 'JP-AUX-BELT',
                    'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/7/73/Timing_belt.jpg',
                    'price' => 39.90,
                    'stock' => 20,
                    'description' => 'Correa auxiliar reforzada para motores japoneses 4 cilindros. Material EPDM anti-temperatura.',
                ],
                [
                    'name' => 'Bujías iridio NGK Laser',
                    'sku' => 'NGK-IR-LZ',
                    'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/2/2e/Spark_plugs.jpg',
                    'price' => 48.00,
                    'stock' => 30,
                    'description' => 'Juego de bujías iridio NGK para mejor encendido y menor consumo en motores gasolina.',
                ],
            ],
        };
    }

    public function run(): void
    {
        Part::truncate();

        CarVersion::with(['carYear.carModel.brand'])->orderBy('id')->each(function (CarVersion $version) {
            $brandName = $version->carYear?->carModel?->brand?->name ?? 'Generic';
            $modelName = $version->carYear?->carModel?->name ?? '';

            $parts = ($brandName === 'Honda' && $modelName === 'Accord')
                ? $this->hondaAccordParts()
                : $this->partsByBrand($brandName);

            foreach ($parts as $partData) {
                Part::create([
                    'car_version_id' => $version->id,
                    ...$partData,
                    'agotado' => $partData['stock'] <= 0,
                ]);
            }
        });
    }
}
