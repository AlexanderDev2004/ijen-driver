<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('tours', 'deleted_at')) {
            DB::table('tours')->whereNotNull('deleted_at')->delete();

            Schema::table('tours', function (Blueprint $table) {
                $table->dropColumn('deleted_at');
            });
        }
    }

    public function down(): void
    {
        if (!Schema::hasColumn('tours', 'deleted_at')) {
            Schema::table('tours', function (Blueprint $table) {
                $table->timestamp('deleted_at')->nullable()->after('updated_at');
            });
        }
    }
};
