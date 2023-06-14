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
        Schema::create('salaries', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("employee_id")->unsigned();
            $table->string("position_title", 30);
            $table->double("position_bonus", 10, 2);
            $table->double("total_salary", 10, 2);
            $table->tinyInteger("month");
            $table->smallInteger("year");
            $table->foreign("employee_id")->references("id")->on("employees")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salaries');
    }
};
