<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AdminsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
       
        $admins=\App\User::whereRoleIs('user')->when($request->search,function($query) use ($request){
            return $query->where('name','like','%'.$request->search.'%');
        })->latest()->paginate(1);
        return view('admins.index',compact('admins'));
    }
    public function create()
    {
        $user=\App\User::all();
        return view('admins.create',compact('user'));
    }
    public function store(Request $request)
    {
       
        $this->validate($request,[
            'name' => 'required',
        'email' => 'required',
        'password' => 'required',
        'photo' => 'required|image',


        ]);
        $photo=$request->photo;
        $new_photo=time().$photo->getClientOriginalName();
        $photo->move('uploads/admins/',$new_photo);

        
       
        $admin=\App\User::create([
            'name' => $request->name,
            'email' =>  $request->email,
            'photo'=>'uploads/admins/'.$new_photo,
            'password' => Hash::make($request->password),

        ]);
        $admin->attachRole('user');
       
        $admin->syncPermissions($request->permissions);
         session()->flash('success',__('added_sucessfully'));
        
       
       
        return redirect()->route('admin.create');
    }

    public function edit($id)
    {
        $admin=\App\User::where('id',$id)->first();
        
        return view('admins.edit',compact('admin'));
        
      

    }

    public function update(Request $request,$id)
    {
        $admin=\App\User::where('id',$id)->first();

        $this->validate($request,[
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',

        ]);


            $admin->name = $request->name;
            $admin->email = $request->email;
            $admin->password = Hash::make($request->password);
            $admin->save();
            $admin->syncPermissions($request->permissions);
            return redirect()->route('admins');


    }
    public function destroy($id)
    {
        $admin=\App\User::find($id);
        
        $admin->delete();
        
        noty('Success Message', 'success');
        return back();
    }
    
}
