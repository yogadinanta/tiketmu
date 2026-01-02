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
       Schema::table('penarikans', function (Blueprint $table) {
    $table->string('bank')->after('jumlah');
    $table->string('no_rekening')->after('bank');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penarikans', function (Blueprint $table) {
            //
        });
    }
};
