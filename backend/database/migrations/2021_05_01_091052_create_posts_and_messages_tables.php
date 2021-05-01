<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsAndMessagesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('directory_id')->default(1)->constrained()->onDelete('cascade');
            $table->string('header', 64);
            $table->timestamps();
        });
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->text('content');
            $table->foreignId('author_id');
            $table->foreignId('post_id') // post_id keeps post id for init message
                ->nullable()
                ->default(null) // null need for creation message with post
                ->constrained()->onDelete('cascade');
            $table->timestamps();
        });
        Schema::table('posts', function (Blueprint $table){
            $table->foreignId('message_id')->unique()->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
        Schema::dropIfExists('messages');
    }
}
