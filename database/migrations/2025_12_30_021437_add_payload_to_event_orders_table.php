<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('event_orders', function (Blueprint $table) {
            $table->longText('payload')->nullable()->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('event_orders', function (Blueprint $table) {
            $table->dropColumn('payload');
        });
    }
};
