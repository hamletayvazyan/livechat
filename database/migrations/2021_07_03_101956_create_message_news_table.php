<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessageNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message_news', function (Blueprint $table) {
            $table->id();
	        $table->unsignedBigInteger('author_id')->index();
	        $table->unsignedBigInteger('user_id')->index();
	        $table->unsignedBigInteger('blogger_id')->index();
	        $table->unsignedBigInteger('advertiser_id')->index();
	        $table->unsignedBigInteger('chat_new_id')->nullable()->index();
	        $table->text('text');
	        $table->bigInteger('file_id')->nullable();
	        $table->boolean('is_read')->default(false);
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
        Schema::dropIfExists('message_news');
    }
}
