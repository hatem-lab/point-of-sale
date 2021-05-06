<?php

namespace App;
use \App\Product;
use Illuminate\Database\Eloquent\Model;
use Laratrust\Traits\LaratrustUserTrait;
class Category extends Model
{
    use LaratrustUserTrait;
    protected $fillable=['name'];
    public function products()
    {
      return $this->hasMany('\App\Product');
    }
   
}
