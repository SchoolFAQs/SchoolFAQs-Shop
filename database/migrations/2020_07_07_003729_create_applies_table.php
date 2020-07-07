<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applies', function (Blueprint $table) {
            $table->id();
            $table->string('user_name');
            $table->string('user_email')->unique();
            $table->date('date_of_birth');
            $table->string('user_tel');
            $table->string('id_card');
            $table->string('license');
            $table->string('kyc_form');
            $table->integer('is_approve')->nullable();
            $table->integer('is_reject')->nullable();
            $table->string('admin_name')->nullable();
            $table->timestamp('solve_date')->nullable();
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
        Schema::dropIfExists('applies');
    }
}
