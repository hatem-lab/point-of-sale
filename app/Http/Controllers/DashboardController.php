<?php

namespace App\Http\Controllers;
use \App\User;
use \App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class DashboardController extends Controller
{
    public function index()
    { 
        
            
        
        $user=\App\User::whereRoleIs('user')->get();
        $category=\App\Category::all();
        $product=\App\Product::all();
        $client=\App\Client::all();
        
        $year = \App\Order::select(
            DB::raw('YEAR(created_at) as year'),
        )->groupBy('year')->get();
                
        $sales_data = \App\Order::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(total_price) as sum')
        )->groupBy('month')->get();
        
        return view('dashboard',compact('user','category','product','client','sales_data','year'));
    }
    public function getYear($year)
    {
        
        
        $sales_data = \App\Order::whereYEAR('created_at','=',$year)->select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(total_price) as sum')
        )->groupBy('month')->get();

 
        
        $view = view('ajax',compact('year'))->with(['sales_data'=>$sales_data ])
            ->renderSections();
 
        return response()->json([
            'status' => true,
              'content' => $view['main'] , 
            ]);
      
 
       
        }
}
