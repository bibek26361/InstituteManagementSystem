<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Instructor;
use Illuminate\Http\Request;

class InstructorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $i = 1;
        $instructor = Instructor::all();
        return view('admin.instructor.index',compact('i','instructor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branch = Branch::whereStatus('on')->get();
        return view('admin.instructor.create',compact('branch'));
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
            
            'branch_id' => ['required', ],
            'name' => ['required', ],
            'age' => ['required', ],
            'address' => ['required', ],
            'email' => ['required','unique:instructors' ],
            'phone' => ['required', 'unique:instructors'],
        ]);

        $instructor= new Instructor();
        if ($request->hasFile('photo')){
        $image = time().'.'.$request->file('photo')->getClientOriginalExtension();
        move_uploaded_file($request->photo, 'public/image/instructor/'.$image);
        $instructor->photo = $image;

        $instructor-> branch_id = $request->get('branch_id');
            $instructor-> name = $request->get('name');
            $instructor-> address = $request->get('address');
            $instructor-> age = $request->get('age');
            $instructor-> phone = $request->get('phone');
            $instructor-> email = $request->get('email');
            $instructor-> status = $request->get('status');
            $instructor-> password = bcrypt($request->get('password'));
        }
        else{
            $instructor-> branch_id = $request->get('branch_id');
            $instructor-> name = $request->get('name');
            $instructor-> address = $request->get('address');
            $instructor-> age = $request->get('age');
            $instructor-> phone = $request->get('phone');
            $instructor-> email = $request->get('email');
            $instructor-> status = $request->get('status');
            $instructor-> password = bcrypt($request->get('password'));
        }
        $instructor->save();
        return redirect()->route('instructor.index')
            ->with('success','Instructor created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Instructor  $instructor
     * @return \Illuminate\Http\Response
     */
    public function show(Instructor $instructor)
    {
      //
    }

    public function changePassword(Request $request, $id){
        
        $instructor = Instructor::find($id);
        $instructor-> password = bcrypt($request->get('password'));
        $instructor->save();
        return redirect()->route('instructor.index')
         ->with([
            'icon' => 'success',
            'message' => 'Password changed successfully'
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Instructor  $instructor
     * @return \Illuminate\Http\Response
     */
    public function edit(Instructor $instructor)
    {
        $branch = Branch::whereStatus('on')->get();
        return view('admin.instructor.edit',compact('instructor','branch'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Instructor  $instructor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Instructor $instructor)
    {
        $validated = $request->validate([
            'name' => ['required', ],
            'age' => ['required', ],
            'address' => ['required', ],
            'email' => 'required|unique:instructors,email,'.$instructor->id, 
            'phone' => 'required|min:10|max:15|unique:instructors,phone,'.$instructor->id,
        ]);

        if ($request->hasFile('photo')){
            $imageName = time().'.'.$request->file('photo')->getClientOriginalExtension();
            if($instructor->photo!=""){
            if (file_exists('public/image/instructor/'.$instructor->photo)){
            unlink('public/image/instructor/'.$instructor->photo);
                }
            }
             move_uploaded_file($request->photo, 'public/image/instructor/'.$imageName); 
            
            $instructor-> photo = $imageName;            
        
                 
            $instructor-> branch_id = $request->get('branch_id');
            $instructor-> name = $request->get('name');
            $instructor-> address = $request->get('address');
            $instructor-> age = $request->get('age');
            $instructor-> phone = $request->get('phone');
            $instructor-> email = $request->get('email');
        }
        else{
                  
            $instructor-> branch_id = $request->get('branch_id');
            $instructor-> name = $request->get('name');
            $instructor-> address = $request->get('address');
            $instructor-> age = $request->get('age');
            $instructor-> phone = $request->get('phone');
            $instructor-> email = $request->get('email');
        }
            $instructor->save();
            
            return redirect()->route('instructor.index')
                ->with('success','Instructor Form updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Instructor  $instructor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Instructor $instructor)
    {
        $instructor->delete();
       
        return redirect()->route('instructor.index')
                        ->with('success','Instructor deleted successfully');
    }


    // ========================= Status Update Controller =================

    public function onStatus(Request $request, $id)
    {
        $status = Instructor::find($id);
        $status-> status = 'on';
        $status->save();
        return redirect()->route('instructor.index')
            ->with('success','Status Active successfully.');
    }

    public function offStatus(Request $request, $id)
    {
        $status = Instructor::find($id);
        $status-> status = 'off';
        $status->save();
        return redirect()->route('instructor.index')
            ->with('success','Status DeActive successfully.');
    }
}
