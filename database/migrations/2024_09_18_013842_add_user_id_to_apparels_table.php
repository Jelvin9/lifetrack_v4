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
        Schema::table('apparels', function (Blueprint $table) {
           // Adding the user_id column as an unsigned big integer (foreign key to users table)
        $table->unsignedBigInteger('user_id')->after('id')->nullable();

        // Optionally, add a foreign key constraint
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('apparels', function (Blueprint $table) {
            // Dropping the foreign key and user_id column
        $table->dropForeign(['user_id']);
        $table->dropColumn('user_id');
        });
    }
};
