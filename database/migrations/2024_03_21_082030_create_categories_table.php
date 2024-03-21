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
        Schema::create('categories', function (Blueprint $table) {

            $table->string('category')->primary()->unique();
            $table->timestamps();
        });

        Schema::table('blogs', function (Blueprint $table) {
            $table->string('category_name'); // Define category_name column in blogs table

            $table->foreign('category_name') // Reference category_name column
                ->references('category')->on('categories')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
