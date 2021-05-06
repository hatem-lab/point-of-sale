<?php

namespace App;
use \App\Category;
use Illuminate\Database\Eloquent\Model;
use Laratrust\Traits\LaratrustUserTrait;
class Product extends Model
{
    use LaratrustUserTrait;
    protected $fillable=['name','category_id','photo','description','purchase_price','sale_price','stock'];
    protected $appends=['image_path'];
    public function getImagePathAttribute(){
        return asset($this->photo);
    }
    public function category()
    {
        return  $this->belongsTo('\App\Category');
    }
    
    public function orders()
    {
        return $this->belongsToMany('App\Order', 'product_order');
    }
    
}
