<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('dive_sites', function (Blueprint $table) {
            $table->id();
            $table->string('site_name')->unique();
            $table->unsignedTinyInteger('minimum_certification_level');
            $table->decimal('required_max_depth', 5, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dive_sites');
    }
};
