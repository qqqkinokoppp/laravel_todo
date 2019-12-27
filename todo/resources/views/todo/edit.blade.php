@extends('layouts.app')

@section('title','Todo')

@section('main_title')
Todo管理アプリ
@endsection

@section('content')
<p>ようこそ、{{ $login_user ->family_name. $login_user ->first_name}}さん</p>

<form action="{{ route('todo.store') }}" method="post">
    {{ csrf_field() }}
    <table class="list">
        <tr>
            <th>項目名</th>
            <td class="align-left">
            <input type="text" name="item_name" id="item_name" class="item_name" value="{{$todo_item ->item_name}}">
            </td>
        </tr>
        <tr>
            <th>担当者</th>
            <td class="align-left">
                <select name="user_id" id="user_id" class="user_id">
                    {{-- <option value="">--選択してください--</option> --}}
                    @foreach ($all_users as $user)
                <option value="{{$user ->id}}" @if($todo_item ->user_id == $user ->id){{'selected'}}@endif>{{$user ->family_name.$user ->first_name}}</option>
                    @endforeach
                </select>
            </td>
        </tr>
        <tr>
            <th>期限</th>
            <td class="align-left">
                <input type="date" name="expire_date" id="expire_date" class="expire_date" value="{{$todo_item ->expire_date}}">
            </td>
        </tr>
        <tr>
            <th>
                完了
            </th>
            <td class="align-left">
                <input type="checkbox" name="finished_date" id="finished_date" class="finished_date" value="1" @if(isset($todo_item ->finished_date)){{'checked'}}@endif> 完了
            </td>
        </tr>
    </table>

    <input type="submit" value="登録">
    <input type="button" value="キャンセル" onclick="location.href='./';">
</form>
</form>

@endsection
