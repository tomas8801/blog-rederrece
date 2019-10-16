<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('user_id'); // id del usuario del post
            $table->unsignedBigInteger('category_id'); //id de la categoria del post
            $table->string('name', 128);
            $table->string('slug', 128)->unique(); //URL amigable
            $table->mediumText('excerpt')->nullable(); //extracto
            $table->mediumText('body');
            $table->enum('status',['PUBLISHED', 'DRAFT'])->default('DRAFT'); //estado PUBLICADO-BORRADOR
            $table->string('file', 128)->nullable(); //un post puede o no tener una img

            $table->timestamps();

            //relations
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade') //el user_id de la tabla post va a hacer referencia al id de la tabla user.
                ->onUpdate('cascade'); //si eliminamos un usuario se van a eliminar los posts de ese usuario.
            $table->foreign('category_id')->references('id')->on('categories')
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
        Schema::dropIfExists('posts');
    }
}
