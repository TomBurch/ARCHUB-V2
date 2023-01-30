<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('missions', function (Blueprint $table) {
            $table->json('orbats')->nullable();
        });
    }

    public function down()
    {
        Schema::table('missions', function (Blueprint $table) {
            $table->dropColumn('orbats');
        });
    }
};
