<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Pastikan kolom id ada
            if (!Schema::hasColumn('users', 'user_id')) {
                $table->id();
            }
            
            // Pastikan kolom remember_token ada
            if (!Schema::hasColumn('users', 'remember_token')) {
                $table->rememberToken();
            }
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Rollback jika diperlukan
        });
    }
}