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
        Schema::create('reservation_dates', function (Blueprint $table) {
            $table->id();
            $table->date('date')->unique();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reservation_dates');
    }
};
