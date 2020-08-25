<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuctionsDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auctions_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('auction_id');
            $table->unsignedBigInteger('user_id');
            $table->double('bid_price');
            $table->date('bid_time');
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
        Schema::dropIfExists('auctions_detail');
    }
}
