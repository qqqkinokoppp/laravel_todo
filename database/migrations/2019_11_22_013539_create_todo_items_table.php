<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTodoItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('todo_items', function (Blueprint $table) {
            $table ->increments('id') ->comment('ID');
            $table ->Integer('user_id') ->null() ->comment('ユーザーID');
            $table ->string('item_name') ->null()->comment('項目名');
            $table ->date('registration_date') ->nullable() ->comment('登録日');
            $table ->date('expire_date') ->nullable() ->comment('期限日');
            $table ->date('finished_date') ->nullable() ->comment('完了日');
            // $table->tinyInteger('is_deleted') ->null() ->comment('削除フラグ');
            // 論理削除を実装
            $table ->softDeletes();
            $table->timestamps();
            // $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            // $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));

            // $table ->primary('id');
            $table ->index('user_id');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('todo_items');
    }
}
