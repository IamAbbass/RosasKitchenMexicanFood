<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UnitController extends Controller
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
            $units = Unit::where('business_id','=',auth()->user()->business_id)->get();
            // passing data into view
            return view('units.index', compact('units'));
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
            return view('units.create');
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
                'name'       =>  'required|unique:units,name',
            ]);
    
            Unit::create([
                'business_id'   => auth()->user()->business_id,
                'name'          => $request['name'],
                'record_by'     => auth()->id(),
            ]);
            
            session()->flash('success','Record entered successfully.');
            return redirect()->route('units.index');
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function show(Unit $unit)
    {
        if (Gate::allows('isShow')) {
            return view('units.show');
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function edit(Unit $unit)
    {
        if (Gate::allows('isEdit')) {
            return view('units.edit', compact('unit'));
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
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Unit $unit)
    {
        if (Gate::allows('isUpdate')) {
            $request->validate([
                'name'       =>  'required|unique:units,name',
            ]);
    
            $unit->update([
                'business_id'   => auth()->user()->business_id,
                'name'          => $request['name'],
                'record_by'     => auth()->id(),
            ]);
            
            session()->flash('success','Record update successfully.');
            return redirect()->route('units.index');
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unit $unit)
    {
        if (Gate::allows('isDestroy')) {
            // $unit->delete();
            session()->flash('success','Record removed successfully.');
            return redirect()->route('units.index');
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }

    public function is_available($id)
    {
        if(Gate::allows('isOwner')) {
            if (Gate::allows('isAvailable')) {
                $result = Unit::findOrFail($id);
                $result->update([
                    'is_available' => $result->is_available == 0 ? 1 : 0,
                    'record_by' => auth()->id()
                ]);
    
                session()->flash('success','Status update successfully.');
                return redirect()->route('units.index');
            }
            else {
                session()->flash('error','This action is unauthorized.');
                return redirect()->back();
            }
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }
}
