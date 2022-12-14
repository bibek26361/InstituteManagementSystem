<?php

namespace App\Http\Controllers;


use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $i = 1;
        $branch = Branch::all();
        return view('admin.branch.index',compact('i','branch'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.branch.create');

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
            
            'name' => ['required'],
            'address' => ['required'],
            'panVat' => ['required'],
            'phone' => ['required', 'unique:branches'],
            'email' => ['required', 'unique:branches'],
        ]);
    
    $branch = Branch::create($request->all());
    return redirect()->route('branch.index')
        ->with('success','Branch created successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function show(Branch $branch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function edit(Branch $branch)
    {
        
        return view('admin.branch.edit',compact('branch'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Branch $branch)
    {
        $validated = $request->validate([
           
            'name' => ['required'],
            'address' => ['required'],
            'panVat' => ['required'],
            'phone' => 'required|min:10|max:15|unique:branches,phone,'.$branch->id,
            'email' => 'required|unique:branches,email,'.$branch->id,
        ]);
        
        $branch->update($request->all());
        return redirect()->route('branch.index')
            ->with('success','Branch Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Branch $branch)
    {
        $branch->delete();
       
        return redirect()->route('branch.index')
                        ->with('success','Branch deleted successfully');
    }

    // ========================= Status Update Controller =================

    public function onStatus(Request $request, $id)
    {
        $status = Branch::find($id);
        $status-> status = 'on';
        $status->save();
        return redirect()->route('branch.index')
            ->with('success','Status Active successfully.');
    }

    public function offStatus(Request $request, $id)
    {
        $status = Branch::find($id);
        $status-> status = 'off';
        $status->save();
        return redirect()->route('branch.index')
            ->with('success','Status DeActive successfully.');
    }
}
