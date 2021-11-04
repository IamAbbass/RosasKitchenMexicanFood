<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class SupplierController extends Controller
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
            $suppliers = Supplier::where('business_id','=',auth()->user()->business_id)->get();
            // passing data into view
            return view('suppliers.index', compact('suppliers'));
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
            return view('suppliers.create');
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
                'business_name' =>  'required',
                'phone'         =>  'required',
                'address'       =>  'required',
            ]);
    
            Supplier::create([
                'business_id'   => auth()->user()->business_id,
                'name'          => $request['name'],
                'designation'   => $request['designation'],
                'business_name' => $request['business_name'],
                'phone'         => $request['phone'],
                'whatsapp'      => $request['whatsapp'],
                'email'         => $request['email'],
                'address'       => $request['address'],
                'ntn'           => $request['ntn'],
                'strn'          => $request['strn'],
                'record_by'     => auth()->id(),
            ]);
            
            session()->flash('success','Record entered successfully.');
            return redirect()->route('suppliers.index');
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        if (Gate::allows('isShow')) {
            return view('suppliers.show');
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        if (Gate::allows('isEdit')) {
            return view('suppliers.edit', compact('supplier'));
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
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        if (Gate::allows('isUpdate')) {
            $request->validate([
                'name'          =>  'required',
                'business_name' =>  'required',
                'phone'         =>  'required',
                'address'       =>  'required',
            ]);
    
            $supplier->update([
                'business_id'   => auth()->user()->business_id,
                'name'          => $request['name'],
                'designation'   => $request['designation'],
                'business_name' => $request['business_name'],
                'phone'         => $request['phone'],
                'whatsapp'      => $request['whatsapp'],
                'email'         => $request['email'],
                'address'       => $request['address'],
                'ntn'           => $request['ntn'],
                'strn'          => $request['strn'],
                'record_by'     => auth()->id(),
            ]);
            
            session()->flash('success','Record update successfully.');
            return redirect()->route('suppliers.index');
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        if (Gate::allows('isDestroy')) {
            // $supplier->delete();
            session()->flash('success','Record removed successfully.');
            return redirect()->route('suppliers.index');
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }

    public function is_available($id)
    {
        if (Gate::allows('isAvailable')) {
            $result = Supplier::findOrFail($id);
            $result->update([
                'is_available' => $result->is_available == 0 ? 1 : 0,
                'record_by' => auth()->id()
            ]);
            session()->flash('success','Status update successfully.');
            return redirect()->route('suppliers.index');
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }
}
