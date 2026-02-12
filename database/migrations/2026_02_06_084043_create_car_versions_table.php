<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration {
    public function up(): void
    {
        Schema::create('car_versions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_year_id')->constrained('car_years')->onDelete('restrict');
            $table->string('name');



            $table->unique(['car_year_id', 'name']);
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('car_versions');
    }
};
