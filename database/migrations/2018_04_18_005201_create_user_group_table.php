<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_group', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('group_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('my_users')->onDelete('cascade');
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
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
        //Schema::dropIfExists('user_group');
        Schema::table('user_group', function (Blueprint $table) {
            $table->dropForeign('user_group_user_id_foreign');
            $table->dropColumn('user_id');
            $table->dropForeign('user_group_group_id_foreign');
            $table->dropColumn('group_id');
        });
        Schema::dropIfExists('user_group');
    }
}
