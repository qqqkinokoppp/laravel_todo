<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Collection;
use IntlCodePointBreakIterator;

class Todo_item extends Model
{
    //
    use SoftDeletes;

    protected $fillable = [
        'item_name', 'registration_date', 'expire_date', 'finished_date', 'updated_at', 'created_at'
    ];

    /**
     * todo全取得メソッド
     *
     * @param Int $user_id
     * @return void
     */
    public function getAllTodoItems()
    {
        return $this::with('user') ->where('deleted_at', null) ->orderBy('expire_date', 'DESC')->paginate(5);
    }

    /**
     * todo取得メソッド
     *
     * @param Int $user_id
     * @return void
     */
    public function getTodoItem(Int $id)
    {
        return $this::with('user') ->where('id', $id)->where('deleted_at', null) ->orderBy('expire_date', 'DESC')->first();
    }

    /**
     * ユーザーテーブルとのリレーション
     *
     * @param
     * @return void
     */
    public function user()
    {
        return $this ->belongsTo('App\User');
    }

    /**
     * todo更新メソッド
     *
     * @param Int $todo_id
     * @param Array $data
     * @return void
     */
    public function todoUpdate(Int $todo_item_id, Array $array)
    {
        if(isset($array['finished_date'])) {
            $param = ['user_id' => $array['user_id'],
                'item_name' => $array['item_name'],
                'registration_date' => now()->format('Y-m-d'),
                'expire_date' => $array['expire_date'],
                'finished_date' => $array['finished_date']
            ];
            // dd($array);
        } else {
            $param = ['user_id' => $array['user_id'],
                'item_name' => $array['item_name'],
                'registration_date' => now()->format('Y-m-d'),
                'expire_date' => $array['expire_date'],
            ];
            // dd($array);
        }
        // dd($param);
        $todo_item =new Todo_item();
        $todo_item ->where('id',$todo_item_id) ->update($param);
    }

    /**
     * todo完了メソッド
     *
     * @param Int $todo_id
     * @return void
     */
    public function todoFinish(Int $todo_item_id)
    {
        // $this ->id = $todo_item_id;
        // $this ->finished_date = now()->format('Y-m-d');
        // dd($this ->finished_date);
        $param = ['finished_date' => now()->format('Y-m-d')];
        // dd($todo_item_id);
        $this ->where('id', $todo_item_id) ->update($param);
    }

    /**
     * todo登録メソッド
     * @param Array
     */
    public function todoStore(Array $array)
    {
        // dd($array);
        if(isset($array['finished_date'])) {
            $param = ['user_id' => $array['user_id'],
                'item_name' => $array['item_name'],
                'registration_date' => now()->format('Y-m-d'),
                'expire_date' => $array['expire_date'],
                'finished_date' => $array['finished_date']
            ];
            // dd($array);
        } else {
            $param = ['user_id' => $array['user_id'],
                'item_name' => $array['item_name'],
                'registration_date' => now()->format('Y-m-d'),
                'expire_date' => $array['expire_date'],
            ];
            // dd($array);
        }
        // dd($param);
        $todo_item =new Todo_item();
        $todo_item ->insert($param);
    }


    public function todoDestroy(Int $todo_item_id)
    {
        return $this->where('id', $todo_item_id)->delete();
    }
}
