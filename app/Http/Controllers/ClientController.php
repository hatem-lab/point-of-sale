<?php

namespace App\Http\Controllers;

use App\Clinet;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $clients=\App\Client::when($request->search1,function($query) use ($request){
            return $query->where('name','like','%'.$request->search1.'%')->
            orWhere('address','like','%'.$request->search1.'%');
        })->latest()->paginate(5);
      
        return view('clients.index',compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients.create');
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
            'phone1' => 'required',
            'address' => 'required',
        ]);
        
       
        $client=\App\Client::create([

            'name' => $request->name,
            'phone1' => $request->phone1,
            'phone2' => $request->phone2,
            'address' => $request->address,
           ]);

         
        return redirect()->route('clients');
    }

    
    public function edit($id)
    {
        $client=\App\Client::where('id',$id)->first();
        return view('clients.edit',compact('client'));
    }

    public function update(Request $request, $id)
    {
        $client=\App\Client::where('id',$id)->first();
        $this->validate($request,[
            'name' => 'required',
            'phone1' => 'required',
            'address' => 'required',
        ]);
        
        $client->name = $request->name;
        $client->phone1 = $request->phone1;
        $client->phone2 = $request->phone2;
        $client->address = $request->address;
        $client->save();
        return redirect()->route('clients');
          
    }

    public function destroy($id)
    {
        $client=\App\Client::where('id',$id)->first();
        $client->delete();
        return redirect()->back();
    }
}



