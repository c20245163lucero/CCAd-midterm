<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('dive_equipment', function (Blueprint $table) {
            $table->id();
            $table->string('gear_item_name');
            $table->string('gear_serial')->unique();
            $table->decimal('daily_fee', 10, 2);
            $table->string('status')->default('available')->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dive_equipment');
    }
};
