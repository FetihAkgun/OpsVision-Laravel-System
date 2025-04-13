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
        Schema::table('incidents', function (Blueprint $table) {
            // Önce foreign key kısıtlamasını kaldır
            if (Schema::hasColumn('incidents', 'service_id')) {
                $table->dropForeign(['service_id']);
                $table->dropColumn('service_id');
            }
            
            // Yeni sütunları ekle
            if (!Schema::hasColumn('incidents', 'started_at')) {
                $table->timestamp('started_at')->nullable()->after('impact');
            }
            
            if (!Schema::hasColumn('incidents', 'visible')) {
                $table->boolean('visible')->default(true)->after('resolved_at');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('incidents', function (Blueprint $table) {
            // Eklenen sütunları kaldır
            if (Schema::hasColumn('incidents', 'started_at')) {
                $table->dropColumn('started_at');
            }
            
            if (Schema::hasColumn('incidents', 'visible')) {
                $table->dropColumn('visible');
            }
            
            // Service_id sütununu geri ekle
            if (!Schema::hasColumn('incidents', 'service_id')) {
                $table->foreignId('service_id')->nullable()->constrained();
            }
        });
    }
};
