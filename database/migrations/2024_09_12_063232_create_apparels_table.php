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
        Schema::create('apparels', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('color');
            $table->integer('quantity')->nullable();
            $table->decimal('price');
            $table->date('date');
            $table->string('remarks')->nullable();
            $table->string('attachment')->nullable();
            $table->foreignIdFor(\App\Models\ApparelCategory::class);
            $table->foreignIdFor(\App\Models\ApparelType::class);
            $table->foreignIdFor(\App\Models\ApparelStyle::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apparels');
    }
};
