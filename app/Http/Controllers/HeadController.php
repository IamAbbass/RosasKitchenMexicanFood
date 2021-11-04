<?php

namespace App\Http\Controllers;

use App\Models\Head;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class HeadController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::allows('isIndex')) {
            $heads = Head::where('business_id','=',auth()->user()->business_id)->get();
            // passing data into view
            return view('heads.index', compact('heads'));
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::allows('isCreate')) {
            return view('heads.create');
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Gate::allows('isStore')) {
            $request->validate([
                'name'       =>  'required',
            ]);
    
            Head::create([
                'business_id'     => auth()->user()->business_id,
                'name'       => $request['name'],
                'record_by'       => auth()->id(),
            ]);
            
            session()->flash('success','Record entered successfully.');
            return redirect()->route('heads.index');
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Head  $head
     * @return \Illuminate\Http\Response
     */
    public function show(Head $head)
    {
        if (Gate::allows('isShow')) {
            return view('heads.show');
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Head  $head
     * @return \Illuminate\Http\Response
     */
    public function edit(Head $head)
    {
        if (Gate::allows('isEdit')) {
            return view('heads.edit', compact('head'));
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Head  $head
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Head $head)
    {
        if (Gate::allows('isUpdate')) {
            $request->validate([
                'name'       =>  'required',
            ]);
    
            $head->update([
                'business_id'     => auth()->user()->business_id,
                'name'       => $request['name'],
                'record_by'       => auth()->id(),
            ]);
            
            session()->flash('success','Record update successfully.');
            return redirect()->route('heads.index');
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Head  $head
     * @return \Illuminate\Http\Response
     */
    public function destroy(Head $head)
    {
        if (Gate::allows('isDestroy')) {
            // $head->delete();
            session()->flash('success','Record removed successfully.');
            return redirect()->route('heads.index');
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }

    
    public function is_available($id)
    {
        if (Gate::allows('isAvailable')) {
            $result = Head::findOrFail($id);
            $result->update([
                'is_available' => $result->is_available == 0 ? 1 : 0,
                'record_by' => auth()->id()
            ]);
            session()->flash('success','Status update successfully.');
            return redirect()->route('heads.index');
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }

}
