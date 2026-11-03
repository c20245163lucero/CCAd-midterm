<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('equipment_rentals', function (Blueprint $table) {
            $table->id();

            $table->foreignId('diver_id')
                ->constrained('divers')
                ->onDelete('restrict');

            $table->foreignId('dive_site_id')
                ->constrained('dive_sites')
                ->onDelete('restrict');

            $table->date('rental_start')->index();
            $table->date('rental_end');
            $table->decimal('total_charge', 12, 2)->default(0);
            $table->timestamps();

            $table->index(['diver_id', 'dive_site_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('equipment_rentals');
    }
};
