<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;

use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;



class PostController extends Controller
{
    public function index(Request $request)
    {
        // $post = Post::with('user')->paginate(10);
        $user_id = Auth::id();

        // $post = Post::where('user_id','=',$user_id)->get();
        $post = Post::query()->where('user_id','=',$user_id);
     
       } 
       return view('post.index');
    }
    public function create()
    {
        return view('post.create');
        // return 
    }
    public function store(Request $request) //simpan data post
    {
       // dd($request->all()); tampilin data
        $this->validate($request, [ //untuk validate form
            'judul'     => 'required',
            'isi'     => 'required',
            'slug'     => 'nullable',
            'gambar'     => 'required|mimes:png,jpg,jpeg',

        ]);


        //upload image
        $image = $request->file('gambar');
        $image->storeAs('public/post', $image->hashName()); //store untuk menyimpan image

        $post = Post::create([ //nyimpen data tampil post
            'judul'     => $request->judul,
            'isi'     => $request->isi,
            'user_id' => Auth::id(),
            'slug'     => Str::slug($request->judul),
            'gambar'     => $image->hashName(),

        ]); 
    //     Mail::to(auth()->user('web'))->send(new Mailky($post)); //send to mail (mailtrap) 
    
   

    // MessageCreated::dispatch($post);

    MessageCreated::dispatch(auth()->user('web'), $post);    

    return redirect()->route('data-index');
    // return redirect()->route('data-index');

  

        if ($post) {
            //redirect dengan pesan sukses
            return redirect()->route('data-index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('data-index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }
    public function edit(Post $post) //untuk update data
    {
        return view('update', compact('post')); //untuk menampilkna form saja
    }
    public function update(Request $request, post $post) //aksi untuk menyimpan perubahan data
    {
        $this->validate($request, [
            'judul'     => 'required',
            'isi'     => 'required',
            'slug'     => 'nullable',
        ]);
        

        try {
            DB::transaction(function() use($request, $post){
    
                $post->fill($request->except('gambar'));
                if($request->hasFile('gambar')) {
                    Storage::disk('public')->delete($request->oldImage);
                  //  $image = $request->image->store('gambar', 'public');
                  $image = $request->file('gambar');
                  $image->storeAs('public/post', $image->hashName());
                  $post->gambar = $image->hashName();
                }
                $post->slug = Str::slug($request->judul); //update slug

                // else{
                //     $image = $request->oldImage;
                //  } 
                // $post->image = $image;
                $post->save();
            });
            if ($post) {
            return redirect()->route('data-index')->with(['success' => 'Data Berhasil Diupdate!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('data-index')->with(['error' => 'Data Gagal Diupdate!']);
        }
        } catch (post $e) {
            report($e);
            return redirect()->back()->withErrors(['error' => 'Terjadi Error'])->withInput();
        }

       
        if ($post) {
            //redirect dengan pesan sukses
            return redirect()->route('data-index')->with(['success' => 'Data Berhasil Diupdate!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('data-index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }



    public function destroy($id) //menghapus data post
    {
        $post = Post::findOrFail($id);
        Storage::disk('local')->delete('public/post/' . $post->image);
        $post->delete();

        if ($post) {
            //redirect dengan pesan sukses
            return redirect()->route('data-index')->with(['success' => 'Data Berhasil Dihapus!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('data-index')->with(['error' => 'Data Gagal Dihapus!']);
        }
    }
}
