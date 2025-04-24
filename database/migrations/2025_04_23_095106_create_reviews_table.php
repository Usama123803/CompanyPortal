<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->string('user_name');
            $table->string('email')->unique();
            $table->string('contact_no');
            $table->string('package_code');
            $table->string('nusuk_booking_no');
            $table->string('guide_name');
            $table->string('accommodation');
            $table->string('transportation');
            $table->string('meal');
            $table->string('guide_support_booking_process');
            $table->string('guide_support_hajj');
            $table->string('about_yourself');
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
        Schema::dropIfExists('reviews');
    }
}
