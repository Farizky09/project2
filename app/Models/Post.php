<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'post';
    use HasFactory;
    protected $fillable = [
       'user_id','judul', 'isi', 'slug','gambar'
    ];
    public function users(){
    	return $this->belongsTo(Users::class);
}
}
