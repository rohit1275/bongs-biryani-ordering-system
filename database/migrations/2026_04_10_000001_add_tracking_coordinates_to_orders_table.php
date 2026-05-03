<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders', 'lat')) {
                $table->decimal('lat', 10, 7)->nullable()->after('shipping_address');
            }

            if (!Schema::hasColumn('orders', 'lng')) {
                $table->decimal('lng', 10, 7)->nullable()->after('lat');
            }
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            if (Schema::hasColumn('orders', 'lng')) {
                $table->dropColumn('lng');
            }

            if (Schema::hasColumn('orders', 'lat')) {
                $table->dropColumn('lat');
            }
        });
    }
};
