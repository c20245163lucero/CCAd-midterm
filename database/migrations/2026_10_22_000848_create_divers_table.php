<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('divers', function (Blueprint $table) {
            $table->id();
            $table->string('diver_name');
            $table->string('certification_level');
            $table->string('cert_number')->unique();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('divers');
    }
};
