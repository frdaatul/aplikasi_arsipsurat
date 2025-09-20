<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    protected $fillable = ['number','category_id','title','file_path','archived_at'];
    protected $casts = ['archived_at'=>'datetime'];
    public function category(){ return $this->belongsTo(Category::class); }
}
