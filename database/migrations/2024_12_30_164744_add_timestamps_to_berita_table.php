<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTimestampsToBeritaTable extends Migration
{
    public function up()
    {
        Schema::table('berita', function (Blueprint $table) {
            $table->timestamps(); // Tambahkan created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::table('berita', function (Blueprint $table) {
            $table->dropTimestamps(); // Untuk rollback
        });
    }
}