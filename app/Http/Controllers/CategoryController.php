<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function product_id(Request $request,$id)
    {
        
       
        $products=\App\Product::when($request->search,function($query) use ($request){
            return $query->where('name','like','%'.$request->search.'%');
        })->latest()->paginate(5);
      
        return view('categories.products_id',compact('products'));
    }

    public function index(Request $request)
    {
        $product=\App\Product::all();
        $categories=\App\Category::when($request->search1,function($query) use ($request){
            return $query->where('name','like','%'.$request->search1.'%');
        })->latest()->paginate(5);
       
        return view('categories.index',compact('product','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $this->validate($request,[
            'name' => 'required',
        ]);
        $id=\App\Category::all();
       
        $category=\App\Category::create([

            'name' => $request->name,
           ]);

         
        return redirect()->route('categories');
    }

    

    public function edit( $id)
    {
        $category=\App\Category::where('id',$id)->first();

        return view('categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category=\App\Category::where('id',$id)->first();

        $this->validate($request,[
            'name' => 'required',
        ]);
            $category->name = $request->name;
            
            $category->save();
        return redirect()->route('categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category=\App\Category::find($id);
        $category->delete();
        return back();
    }
}
