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
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('name', 'customer_name');
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('role')->default('customer');
            $table->boolean('active')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('customer_name', 'name');
            $table->dropColumn('phone');
            $table->dropColumn('address');
            $table->dropColumn('role');
            $table->dropColumn('active');
        });
    }
};
