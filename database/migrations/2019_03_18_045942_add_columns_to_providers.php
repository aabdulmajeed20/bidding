<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToProviders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('providers', function (Blueprint $table) {
            $table->string('email')->unique()->after('name');
            $table->string('password')->after('email');
            $table->timestamp('email_verified_at')->nullable()->after('password');
            $table->rememberToken()->after('email_verified_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('providers', function (Blueprint $table) {
            Schema::table('providers', function($table) {
                $table->dropColumn('email');
                $table->dropColumn('password');
                $table->dropColumn('email_verified_at');
                $table->dropColumn('remember_token');
                });
        });
    }
}
