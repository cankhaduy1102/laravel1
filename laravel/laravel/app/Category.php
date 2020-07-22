<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
   protected $table = "categories";
   public $fillable = ['cate_name','show_menu'];
}
