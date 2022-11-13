<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('demonstration_name',100);
            $table->boolean('active');
            $table->string('first_name',50);
            $table->string('last_name',50);
            $table->string('social_id',10);
            $table->timestamp('birthday');
            $table->string('mobile_number',15);
            $table->string('mobile_number_description',100);
            $table->string('email');
            $table->string('email_description',100);
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
        Schema::dropIfExists('customers');
    }
};
