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

        /* TABELLA APPARTEMENTI */
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->string('title', 50)->required();
            $table->text('cover')->required()->nullable();
            $table->text('description');
            $table->boolean('is_visible')->default(0);
            $table->tinyInteger('rooms')->unsigned();
            $table->tinyInteger('beds')->unsigned();
            $table->tinyInteger('bathrooms')->unsigned();
            $table->tinyInteger('sqm')->unsigned();
            $table->string('address', 50);
            $table->decimal('latitude', 10, 6);
            $table->decimal('longitude', 10, 6);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        /* BUTTI GIU' LA TABELLA */
        Schema::dropIfExists('apartments');
    }
};