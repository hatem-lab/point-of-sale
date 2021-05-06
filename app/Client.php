<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laratrust\Traits\LaratrustUserTrait;
class Client extends Model
{
    use LaratrustUserTrait;
    protected $fillable=['name','phone1','phone2','address'];
    
    
    public function orders()
    {
        return $this->hasMany('App\Order');
    }
    
    
    
    
}