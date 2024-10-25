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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->enum('type', ['Expense', 'Income'])->default('Expense');
            $table->foreignIdFor(\App\Models\TransactionCategory::class);
            $table->decimal('amount');
            $table->date('date');
            $table->text('remarks');
            $table->string('attachments');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
