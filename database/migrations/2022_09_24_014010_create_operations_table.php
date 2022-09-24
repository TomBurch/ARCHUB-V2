<?php

use App\Models\Mission;
use App\Models\Operation;
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
        Schema::create('operations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->timestamp('starts_at');
        });

        Schema::create('operation_missions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignIdFor(Operation::class)->cascadeOnDelete();
            $table->foreignIdFor(Mission::class)->cascadeOnDelete();
            $table->integer('play_order');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('operations');
        Schema::dropIfExists('operation_missions');
    }
};
