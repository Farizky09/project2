<?php

namespace App\Http\Controllers;

use App\Models\Todolist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class TodolistController extends Controller
{


    public function index()
    {
        $todolists = Todolist::all();
        return view('todo', compact('todolists'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([

            'content' => 'required'
        ]);
        $todo = new Todolist();
        $todo->fill($request->all());
        $todo->user_id = auth()->user('web')->id;
        $todo->save();

        return $todo;
    }

    public function list()
    {
    $user_id = Auth::id();

    $todo = Todolist::query()->where('user_id','=',$user_id)->get();

    return $todo;
    }


    public function update(Request $request, Todolist $todo) //aksi untuk menyimpan perubahan data
    {
      $todo =  Todolist::findOrFail($todo->content)->where('user_id',$request->id)->update([
    'content' => $request->content,
]);
return $todo;
    }

    public function destroy(Todolist $todolist) //menghapus data todolist
    {
        $todolist->delete();
        return 1;
    }
}
