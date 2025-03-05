<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('plan_days', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plan_id')->constrained()->onDelete('cascade');
            // $table->dateTime('day')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('day')->default(DB::raw("DATE_FORMAT(NOW(), '%Y-%m-%d %H:%i:%s')"));

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('plan_days');
    }
};
