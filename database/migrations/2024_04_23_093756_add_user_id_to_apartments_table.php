<?php

use App\Models\User;
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

        /* AGGIUGNO ALLA TABELLA APPARTMENTI ID DELL'USER */
        Schema::table('apartments', function (Blueprint $table) {
            $table->foreignIdFor(User::class)->after('id')->nullable()->constrained()->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        /* BOTTO GIU' PRIMA LA RELAZIONE POI LA TABELLA */
        Schema::table('apartments', function (Blueprint $table) {
            $table->dropForeignIdFor(User::class);
            $table->dropColumn('user_id');
        });
    }
};