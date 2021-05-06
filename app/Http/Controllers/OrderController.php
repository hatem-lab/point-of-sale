<?php

namespace App\Http\Controllers;

use App\Order;
use App\Client;
use App\Product;
use App\Category;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {

         $orders=\App\Order::with('client')->get();
         return view('clients.orders.showOrder',compact('orders'));

    }
   
    public function create($id)
    {
        $clients=\App\Client::where('id',$id)->first();
        $category=\App\Category::all();
        $product=\App\Product::all();
        return view('clients.orders.create',compact('category','clients','product'));
    }

  

    public function store(Request $request,$id)
    {
       
        $this->validate($request,[
            'quantities' => 'required|array',
            'products_ids' => 'required|array',
        ]);
   
        $client=\App\Client::where('id',$id)->first();
        $order=$client->orders()->create([]);
        $totalPrice=0;
        foreach ($request->products_ids as $key => $value) 
        
    {
        $product=\App\Product::findOrfail($value);
       
       
        $order->products()->attach($value,['quantity'=>$request->quantities[$key]]);
        $totalPrice += $product->sale_price * $request->quantities[$key];
        $product->update([
            'stock'=>$product->stock- $request->quantities[$key],
       ]);
       
    }
    $product=\App\Product::findOrfail($request->products_ids);
    $order->update([
         'total_price'=>$totalPrice, 
    ]);
   

   
     return redirect()->route('client.orders');
    
    }
       

  
    public function show($id)
    {
        $order=\App\Order::where('id',$id)->first();
       $products=$order->products;
       return view('clients.orders._show',compact('products','order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Client $client)
    {
        $category=\App\Category::all();
        
        $order=\App\Order::where('id',$id)->first();
        $products=$order->products;
        $product=\App\Product::all();
        return view('clients.orders.edit',compact('category','products','client','order','product'));
    }

    
    public function update(Request $request,Order $order,Client $client)
    {
        
       
        $order->delete();


        $this->validate($request,[
            'quantities' => 'required|array',
            'products_ids' => 'required|array',
        ]);
   
       
        $order=$client->orders()->create([]);
        $totalPrice=0;
        foreach ($request->products_ids as $key => $value) 
        
    {
        $product=\App\Product::findOrfail($value);
       
       
        $order->products()->attach($value,['quantity'=>$request->quantities[$key]]);
        $totalPrice += $product->sale_price * $request->quantities[$key];
        $product->update([
            'stock'=>$product->stock- $request->quantities[$key],
       ]);
       
    }
    $product=\App\Product::findOrfail($request->products_ids);
    $order->update([
         'total_price'=>$totalPrice, 
    ]);
   

   
     return redirect()->route('client.orders');
    }

   
    public function destroy($id)
    {

        $order=\App\Order::find($id);
        foreach($order->products as $item)
        $item->update([
            'stock'=>$item->stock + $item->pivot->quantity,
        ]);
       
        $order->delete();
        return back();
    }
}
