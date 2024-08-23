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
        Schema::create('reservation_times', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('reservation_date_id')->constrained()->onDelete('cascade');
            $table->foreignId('place_id')->constrained()->onDelete('cascade');
            $table->tinyInteger('hour')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['reservation_date_id', 'place_id', 'hour']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('reservation_times');
    }
};
