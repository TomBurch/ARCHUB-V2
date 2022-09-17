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
        Schema::create('mission_notes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignIdFor(Mission::class)->cascadeOnDelete();
            $table->foreignIdFor(User::class)->cascadeOnDelete();
            $table->longText('text');
            $table->boolean('published');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mission_notes');
    }
};
