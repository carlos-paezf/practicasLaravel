<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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

            /*Como esta tabla maneja un bigIncrements, en las llaves que se vayan
            a manejar, se debe usar la palabra unsignedBigInteger.
            Si el autoincremento esta con la palabra reservada increments, se pueden
            manejar tan solo con el integer*/

            $table->bigIncrements('id');

            $table->unsignedBigInteger('user_id')->unsigned();
            $table->unsignedBigInteger('category_id')->unsigned();

            $table->string('name', 128); // Laravel 6.x
            $table->string('slug', 128)->unique(); // Laravel-6-x

            $table->mediumText('excerpt')->nullable();
            $table->text('body');
            $table->enum('status', ['PUBLISHED', 'DRAFT'])->default('DRAFT');

            $table->string('file', 128)->nullable();

            $table->timestamps();


            //Relation
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')
                ->onDelete('cascade')
                ->onDelete('cascade');
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
