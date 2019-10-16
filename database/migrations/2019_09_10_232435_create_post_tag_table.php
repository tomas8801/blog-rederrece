<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_tag', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('post_id'); // id del usuario del post
            $table->unsignedBigInteger('tag_id'); //id de la categoria del post

            $table->timestamps();

            
            //relations
            $table->foreign('post_id')->references('id')->on('posts')
                ->onDelete('cascade') //el user_id de la tabla post va a hacer referencia al id de la tabla user.
                ->onUpdate('cascade'); //si eliminamos un usuario se van a eliminar los posts de ese usuario.
            $table->foreign('tag_id')->references('id')->on('tags')
                ->onDelete('cascade') 
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_tag');
    }
}
