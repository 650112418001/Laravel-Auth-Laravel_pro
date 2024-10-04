<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->longText('description');
            $table->date('start_date');
            $table->date('end_date');
            $table->time('start_time');
            $table->string('image');
            $table->string('address');
            $table->integer('num_register');
            $table->foreignId('admin_id')->constrained()->cascadeOnDelete();
            $table->foreignId('province_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
