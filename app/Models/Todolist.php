<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todolist extends Model
{
    use HasFactory;
    protected $fillable = ['content'];
    protected $table = 'todolist';
    public function users(){
    	return $this->belongsTo(Users::class);
}
}
