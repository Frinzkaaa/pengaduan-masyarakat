<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::table('petugas', function (Blueprint $table) {
            $table->string('nama', 100)->after('id_petugas');
        });
    }
    public function down() {
        Schema::table('petugas', function (Blueprint $table) {
            $table->dropColumn('nama');
        });
    }
};
