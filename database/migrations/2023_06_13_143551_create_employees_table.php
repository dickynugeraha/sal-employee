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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string("nik", 16);
            $table->string("name", 50);
            $table->string("email", 40);
            $table->string("address", 100);
            $table->string("age", 10);
            $table->string("bank", 10);
            $table->string("no_rekening", 30);
            $table->double("basic_salary", 10, 2);
            $table->string("photo");
            $table->bigInteger("position_id")->unsigned();
            $table->foreign("position_id")->references("id")->on("positions")->onDelete("cascade");
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
        Schema::dropIfExists('employees');
    }
};
