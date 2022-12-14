<?php

namespace App\Http\Controllers;

use App\Models\User_role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $i = 1;
       $user = User::all();       
       return view('admin.user.index',compact('user','i'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_role = User_role::whereStatus('on')->get();
        return view('admin.user.create',compact('user_role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            
            'user_role_id' => ['required' ],
            'name' => ['required' ],
            'address' => ['required' ],
            'phone' => ['required', 'unique:users'],
            'email' => ['required', 'unique:users'],
        ]);
        
        $user= new User();
        if ($request->hasFile('photo')){
        $image = time().'.'.$request->file('photo')->getClientOriginalExtension();
        move_uploaded_file($request->photo, 'public/image/user/'.$image);
        $user->photo = $image;
        $user-> user_role_id = $request->get('user_role_id');
        $user->name = $request->get('name');
        $user->address = $request->get('address');
        $user->email = $request->get('email');
        $user->password = bcrypt($request->get('password'));
        $user->phone = $request->get('phone');
        }
        else{
            $user-> user_role_id = $request->get('user_role_id');
        $user->name = $request->get('name');
        $user->address = $request->get('address');
        $user->email = $request->get('email');
        $user->password = bcrypt($request->get('password'));
        $user->phone = $request->get('phone');
        }
        $user->save();
        return redirect()->route('user.index')
            ->with('success','User created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    public function changePassword(Request $request, $id){
        
        $user = User::find($id);
        $user-> password = bcrypt($request->get('password'));
        $user->save();
        return redirect()->route('user.index')
         ->with([
            'icon' => 'success',
            'message' => 'Password changed successfully'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user_role = User_role::whereStatus('on')->get();
        $user = User::find($id);
        return view('admin.user.edit',compact('user','user_role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            
            'name' => ['required' ],
            'address' => ['required' ],
            'phone' => 'required|min:10|max:15|unique:users,phone,'.$user->id,
            'email' => 'required|unique:users,email,'.$user->id,
        ]);
        if ($request->hasFile('photo')){
            $imageName = time().'.'.$request->file('photo')->getClientOriginalExtension();
            if($user->attachment!=""){
                if (file_exists('public/image/user/'.$user->photo)){
                    unlink('public/image/user/'.$user->photo);
                }
            }     
        
        move_uploaded_file($request->photo, 'public/image/user/'.$imageName); 
            
            $user-> photo = $imageName;       
        
        $user-> user_role_id = $request->get('user_role_id');
        $user->name = $request->get('name');
        $user->address = $request->get('address');
        $user->email = $request->get('email');
        $user->phone = $request->get('phone');
        }
        else{
        $user-> user_role_id = $request->get('user_role_id');
        $user->name = $request->get('name');
        $user->address = $request->get('address');
        $user->email = $request->get('email');
        $user->phone = $request->get('phone');
        }
        $user->save();
            
            return redirect()->route('user.index')
                ->with('success','User Form updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user->delete();
       
        return redirect()->route('user.index')
                        ->with('success','user deleted successfully');
    }

    // ========================= Status Update Controller =================

    public function onStatus(Request $request, $id)
    {
        $status = User::find($id);
        $status-> status = 'on';
        $status->save();
        return redirect()->route('user.index')
            ->with('success','Status Active successfully.');
    }

    public function offStatus(Request $request, $id)
    {
        $status = User::find($id);
        $status-> status = 'off';
        $status->save();
        return redirect()->route('user.index')
            ->with('success','Status DeActive successfully.');
    }
}
