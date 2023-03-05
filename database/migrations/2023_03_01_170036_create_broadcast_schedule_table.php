<?php

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
        Schema::create('broadcast_schedule_programs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('image');
            $table->string('image_alt');
        });

        Schema::create('broadcast_schedule_calendars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_id');
            $table->string('day');
            $table->time('time');
            $table->string('description');
            $table->boolean('highlight')->default(false);

            $table->foreign('program_id')
                ->references('id')
                ->on('broadcast_schedule_programs')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('broadcast_schedule_programs');
    }
};
