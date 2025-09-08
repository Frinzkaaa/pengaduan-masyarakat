<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('masyarakats', function (Blueprint $table) {
            $table->char('nik', 16)->primary();
            $table->string('nama', 25);
            $table->string('username', 25)->unique();
            $table->string('password', 191);
            $table->string('telp', 18);
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('masyarakats');
    }
};
