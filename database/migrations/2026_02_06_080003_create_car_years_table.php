<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration {
    public function up(): void
    {
        Schema::create('car_years', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_model_id')->constrained('car_models')->onDelete('restrict');
            $table->smallInteger('year');



            $table->unique(['car_model_id', 'year']);
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('car_years');
    }
};
