<?php

use App\Models\Apartment;
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

        /* AGGIUNGO ALLA TABELLA MESSAGGI ID DELL'APPARTEMENTO */
        Schema::table('messages', function (Blueprint $table) {
            $table->foreignIdFor(Apartment::class)->after('id')->nullable()->constrained()->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        /* BOTTO GIU' PRIMA LA RELAZIONE POI LA TABELLA */
        Schema::table('messages', function (Blueprint $table) {
            $table->dropForeignIdFor(Apartment::class);
            $table->dropColumn('apartment_id');
        });
    }
};