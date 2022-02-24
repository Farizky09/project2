<?php

namespace App\Http\Controllers;

use App\Models\Todolist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



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
    Todolist::create($data);
    return back();
}
public function destroy(Todolist $todolist) //menghapus data post
{
    $todolist->delete();
   return back(); 
}
}