<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('equipment_rental_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('equipment_rental_id')
                ->constrained('equipment_rentals')
                ->onDelete('cascade');

            $table->foreignId('dive_equipment_id')
                ->constrained('dive_equipment')
                ->onDelete('restrict');

            $table->decimal('daily_fee', 10, 2);
            $table->string('return_condition')->nullable();
            $table->timestamps();

            $table->unique([
                'equipment_rental_id',
                'dive_equipment_id',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('equipment_rental_items');
    }
};
