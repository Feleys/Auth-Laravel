<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collects', function (Blueprint $table) {
            $table->id();
            $table->date('collect_date');
            $table->char('name');
            $table->char('general_score');
            $table->string('general_description');
            $table->char('love_score');
            $table->string('love_description');
            $table->char('career_score');
            $table->string('career_description');
            $table->char('money_score');
            $table->string('money_description');
            $table->dateTime('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('collects');
    }
}
