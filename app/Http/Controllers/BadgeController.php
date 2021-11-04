<?php

namespace App\Http\Controllers;

use App\Models\Badge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class BadgeController extends Controller
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
            $badges = Badge::where('business_id','=',auth()->user()->business_id)->get();
            // passing data into view
            return view('badges.index', compact('badges'));
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
            return view('badges.create');
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
                'name'       =>  'required|unique:badges,name',
            ]);
    
            Badge::create([
                'business_id'   => auth()->user()->business_id,
                'name'          => $request['name'],
                'record_by'     => auth()->id(),
            ]);
            
            session()->flash('success','Record entered successfully.');
            return redirect()->route('badges.index');
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Badge  $badge
     * @return \Illuminate\Http\Response
     */
    public function show(Badge $badge)
    {
        if (Gate::allows('isShow')) {
            return view('badges.show');
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Badge  $badge
     * @return \Illuminate\Http\Response
     */
    public function edit(Badge $badge)
    {
        if (Gate::allows('isEdit')) {
            return view('badges.edit', compact('badge'));
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
     * @param  \App\Models\Badge  $badge
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Badge $badge)
    {
        if (Gate::allows('isUpdate')) {
            $request->validate([
                'name'       =>  'required|unique:badges,name',
            ]);
    
            $badge->update([
                'business_id'   => auth()->user()->business_id,
                'name'          => $request['name'],
                'record_by'     => auth()->id(),
            ]);
            
            session()->flash('success','Record update successfully.');
            return redirect()->route('badges.index');
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Badge  $badge
     * @return \Illuminate\Http\Response
     */
    public function destroy(Badge $badge)
    {
        if (Gate::allows('isDestroy')) {
            // $badge->delete();
            session()->flash('success','Record removed successfully.');
            return redirect()->route('badges.index');
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
                $result = Badge::findOrFail($id);
                $result->update([
                    'is_available' => $result->is_available == 0 ? 1 : 0,
                    'record_by' => auth()->id()
                ]);
    
                session()->flash('success','Status update successfully.');
                return redirect()->route('badges.index');
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
