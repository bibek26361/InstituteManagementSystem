<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $profile = User::all();
        return view('admin.profile.index',compact('profile'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
       return view('admin.profile.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if ($request->hasFile('photo')){
            $imageName = time().'.'.$request->file('photo')->getClientOriginalExtension();
            if(auth()->user()->photo!=""){
                if (file_exists('public/image/user/'.auth()->user()->photo)){
                    unlink('public/image/user/'.auth()->user()->photo);
                }
            }       
       
        move_uploaded_file($request->photo, 'public/image/user/'.$imageName); 

       $user->photo = $imageName;

        
            $user-> name = $request -> get('name');
            $user-> email = $request -> get('email');
            $user-> address = $request -> get('address');
            $user-> phone = $request -> get('phone');
        }
        else{
            $user-> name = $request -> get('name');
            $user-> email = $request -> get('email');
            $user-> address = $request -> get('address');
            $user-> phone = $request -> get('phone');
        }
            $user->save();
        return redirect()->route('profile.index')
            ->with('success','Profile Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
