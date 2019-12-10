@extends('layouts.app')

@yield('title', 'Todo')

<p>ようこそ、{{ $user -> family_name. $user ->first_name}}さん</p>

        <div class="main-header">
            <form action="{{ url('todo/create') }}" method="post">
                @csrf
                <div class="entry">
                    <input type="submit" value="作業登録">
                </div>
            </form>
        </div>

        <table class="table table-striped">
            <tr>
                <th>項目名</th>
                <th>担当者</th>
                <th>登録日</th>
                <th>期限日</th>
                <th>完了日</th>
                <th>操作</th>
            </tr>
            @if (isset($todo_items))
                @foreach ($todo_items as $todo_item)

            @if (!isset($todo_item ->finished_date))
            {!!'<tr style="background-color:#ffbbbb">'!!}
            @endif
                <td class="align-left">
                    {{$todo_item ->item_name}}
                </td>
                <td class="align-left">
                    {{$todo_item -> user ->family_name.$todo_item -> user ->first_name}}
                </td>
                <td>
                    {{$todo_item ->registration_date}}
                </td>
                <td>
                    {{$todo_item ->expire_date}}
                </td>
                <td>

                @if (!isset($todo_item ->finished_date))
                {{'未'}}
                @else
                {{$todo_item ->finished_date}}
                @endif

                </td>
                <td>
                    <form action="{{ url('todo/'.$todo_item ->id) }}" method="post">
                        @csrf
                        <input type="hidden" name="item_id" value="{{$todo_item ->id}}">
                        {{-- {{dd($todo_item ->id)}} --}}
                        <input type="submit" value="完了">
                    </form>

                    <form action="{{ url('todo/'.$todo_item ->id.'/edit') }}" method="post">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="item_id" value="{{$todo_item ->id}}">
                        <input type="submit" value="更新">
                    </form>

                    <form action="{{ url('todo/'.$todo_item ->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="item_id" value="{{$todo_item ->id}}">
                        <input type="submit" value="削除">
                    </form>
                </td>
            </tr>
        @endforeach
        @endif
        </table>
