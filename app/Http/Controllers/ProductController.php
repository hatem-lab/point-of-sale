<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use App\Product;
use App\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {

        $category=\App\Category::all();
       
        $products=\App\Product::when($request->search,function($query) use ($request){

            return $query->where('name','like','%'.$request->search.'%');

        })->when($request->category_id,function($q) use ($request){

            return $q->where('category_id',$request->category_id);
        
        })->latest()->paginate(5);
    
      
    

        return view('products.index',compact('category','products'));
            
    }

    public function create()
    {
        $categories=\App\Category::all();
        $product=\App\Product::all();
        return view('products.create',compact('categories','product'));
    }

   
    public function store(Request $request)
    {
        $this->validate($request,[
        'name' => 'required',
        'category_id' => 'required',
        'description' => 'required',
        'purchase_price' => 'required',
        'sale_price' => 'required',
        'stock' => 'required',
        'photo' => 'required|image',
        ]);
        $photo=$request->photo;
        $new_photo=time().$photo->getClientOriginalName();
        $photo->move('uploads/products/',$new_photo);

       
        \App\Product::create([
           
            'name'=>$request->name,
            'category_id'=>$request->category_id,
            'description'=>$request->description,
            'purchase_price'=>$request->purchase_price,
            'sale_price'=>$request->sale_price,
            'stock'=>$request->stock,
            'photo'=>'uploads/products/'.$new_photo,

        ]);
       
        return redirect()->route('products');
    }

    public function edit( $id)
    {
        
        $categories=\App\Category::all();
        $product=\App\Product::where('id',$id)->first();
        return view('products.edit',compact('categories','product'));
    }

  
    public function update(Request $request,  $id)
    {
        $this->validate($request,[
            'name' => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'purchase_price' => 'required',
            'sale_price' => 'required',
            'stock' => 'required',
            'photo' => 'required|image',
            ]);
            $product=\App\Product::where('id',$id)->first();
            $photo=$request->photo;
        $new_photo=time().$photo->getClientOriginalName();
        $photo->move('uploads/products/',$new_photo);
      

            $product->name=$request->name;
            $product->category_id=$request->category_id;
            $product->description=$request->description;
            $product->purchase_price=$request->purchase_price;
            $product->sale_price=$request->sale_price;
            $product->stock=$request->stock;
            $product->photo='uploads/products/'.$new_photo;
            $product->save();
     
       
        return redirect()->route('products');
    }

  
    public function destroy($id)
    {
        $product=\App\Product::find($id);
        
        $product->delete();
        return back();
    }
}
