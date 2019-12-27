<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id') ->comment('ユーザーID');
            $table->string('user') ->unique() ->null() ->comment('ユーザー名');
            $table->string('password') ->comment('パスワード');
            $table->string('family_name') ->null() -> comment('ユーザー姓');
            $table->string('first_name') ->null() -> comment('ユーザー名');
            $table->tinyInteger('is_admin') ->null() ->comment('管理者権限');
            // $table->tinyInteger('is_deleted') ->null() ->comment('削除フラグ');
            // 論理削除を実装
            $table->softDeletes();
            $table->rememberToken();
            $table->timestamps();

            // $table ->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
