<?php

namespace App\Http\Controllers;

use App\Models\Rider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class RiderController extends Controller
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
            $riders = Rider::where('business_id','=',auth()->user()->business_id)->get();
            // passing data into view
            return view('riders.index', compact('riders'));
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
            return view('riders.create');
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
                'name'          =>  'required',
                'cnic'          =>  'required|unique:riders,cnic',
                'phone'         =>  'required',
                'address'       =>  'required',
            ]);
    
            Rider::create([
                'business_id'   => auth()->user()->business_id,
                'image'         => $request['image'],
                'name'          => $request['name'],
                'cnic'          => $request['cnic'],
                'phone'         => $request['phone'],
                'email'         => $request['email'],
                'address'       => $request['address'],
                'record_by'     => auth()->id(),
            ]);
            
            session()->flash('success','Record entered successfully.');
            return redirect()->route('riders.index');
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rider  $rider
     * @return \Illuminate\Http\Response
     */
    public function show(Rider $rider)
    {
        if (Gate::allows('isShow')) {
            return view('riders.show');
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rider  $rider
     * @return \Illuminate\Http\Response
     */
    public function edit(Rider $rider)
    {
        if (Gate::allows('isEdit')) {
            return view('riders.edit', compact('rider'));
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
     * @param  \App\Models\Rider  $rider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rider $rider)
    {
        if (Gate::allows('isUpdate')) {
            $request->validate([
                'name'          =>  'required',
                'cnic'          =>  'required',
                'phone'         =>  'required',
                'address'       =>  'required',
            ]);
    
            $rider->update([
                'business_id'   => auth()->user()->business_id,
                'image'         => $request['image'],
                'name'          => $request['name'],
                'cnic'          => $request['cnic'],
                'phone'         => $request['phone'],
                'email'         => $request['email'],
                'address'       => $request['address'],
                'record_by'     => auth()->id(),
            ]);
            
            session()->flash('success','Record update successfully.');
            return redirect()->route('riders.index');
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rider  $rider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rider $rider)
    {
        if (Gate::allows('isDestroy')) {
            // $rider->delete();
            session()->flash('success','Record removed successfully.');
            return redirect()->route('riders.index');
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }

    public function is_available($id)
    {
        if (Gate::allows('isAvailable')) {
            $result = Rider::findOrFail($id);
            $result->update([
                'is_available' => $result->is_available == 0 ? 1 : 0,
                'record_by' => auth()->id()
            ]);
            session()->flash('success','Status update successfully.');
            return redirect()->route('riders.index');
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }
}
