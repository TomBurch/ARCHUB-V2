<?php

use App\Models\Mission;
use App\Models\User;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mission_revisions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignIdFor(Mission::class)->cascadeOnDelete();
            $table->foreignIdFor(User::class)->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mission_revisions');
    }
};
