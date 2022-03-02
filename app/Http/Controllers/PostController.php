<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Post;



class PostController extends Controller
{
  //Post List
  public function index()
  {
      return view('post.list');
  }


  //ADD NEW POST
  public function addPost(Request $request){
    $validator = \Validator::make($request->all(),[
      'judul' => 'required|unique:post',
      'isi' => 'required',
      'slug' => 'required',
      'gambar' => 'required',
    ]);

    if(!validator->passes()){
      return response()->json(['code'=>0, 'error'=>$validator->errors()-toArray()]);
    }else{
      $post = new Post();
      $post->judul =$request->judul;
      $post->isi =$request->isi;
      $post->slug =Str::slug($request->judul);
      $post->gambar =$request->gambar;
      $query = $post->save();

      if(!$query){
        return response()->json(['code'=>0, 'msg'=>'Something went wrong']);
      }else{
        return response()->json(['code'=>1, 'msg'=>'New Post has been successfully saved']);

      }
      }
    }
  }
