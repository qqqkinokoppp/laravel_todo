<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Models\Todo_item;

class Todo_itemsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Todo_item $todo_item)
    {
        //
        $login_user = auth() ->user();
        $todo = $todo_item ->getAllTodoItems();
        // dd($todo);

        return view('todo.index',[
            'user'          => $login_user,
            'todo_items'    => $todo
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $login_user = auth()->user();
        $users = new User();
        $all_users = $users ->getAllUser();
        return view('todo.create', [
            'login_user' => $login_user,
            'all_users' => $all_users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Todo_item $todo_item, Request $request)
    {
        //
        $data = $request -> all();
        if (isset($data['finished_date'])) {
            $data['finished_date'] = now() ->format('Y-m-d');
        }
        $validator = Validator::make($data,[
            'user_id' =>['required'],
            'item_name' =>['required','string','max:100'],
            'expire_date' =>['date'],
            // 'finished_date' =>['date']
        ]);
        $validator ->validate();
        // dd($data);
        $todo_item ->todoStore($data);

        return redirect('todo');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $login_user = auth() ->user();
        $users = new User();
        $all_users = $users ->getAllUser();
        $todo_item = new Todo_item();
        $todo_item = $todo_item ->getTodoItem($id);
        // dd($todo_item);
        return view('todo.edit', [
            'login_user' => $login_user,
            'all_users' => $all_users,
            'todo_item' => $todo_item
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Todo_item $todo_item, Request $request)
    {
        $data = $request -> all();
        if (isset($data['finished_date'])) {
            $data['finished_date'] = now() ->format('Y-m-d');
        }
        $validator = Validator::make($data,[
            'user_id' =>['required'],
            'item_name' =>['required','string','max:100'],
            'expire_date' =>['date'],
            'finished_date' =>['date']
        ]);
        // dd($request);
        $validator ->validate();
        // dd($request);
        $todo_item ->updateTodo($todo_item ->id, $data);

        return redirect('todo');
    }

    /**
     * 完了メソッド
     * @param Todo_item
     */
    public function finish(Todo_item $todo_item, Request $request)
    {
        // all() リクエストを配列として受け取る
        $data = $request ->all();
        $todo_item->todoFinish((int)$data['item_id']);
        // dd($todo_item ->id);
        return redirect('todo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo_item $todo_item, Request $request)
    {
        // $user = auth()->user();
        $data = $request ->all();
        $todo_item->todoDestroy($data['item_id']);
        return redirect('todo');
    }
}
