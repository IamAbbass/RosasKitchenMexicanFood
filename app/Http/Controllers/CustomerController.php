<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class CustomerController extends Controller
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
            $customers = Customer::where('business_id','=',auth()->user()->business_id)->get();
            // passing data into view
            return view('customers.index', compact('customers'));
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
        session()->flash('error','This option is temporarily blocked by developer.');
        return redirect()->back();

        if (Gate::allows('isCreate')) {
            return view('customers.create');
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
        session()->flash('error','This option is temporarily blocked by developer.');
        return redirect()->back();

        if (Gate::allows('isStore')) {
            $request->validate([
                'name'          =>  'required',
                'business_name' =>  'required',
                'phone'         =>  'required',
                'address'       =>  'required',
            ]);
    
            Customer::create([
                'business_id'   => auth()->user()->business_id,
                'name'          => $request['name'],
                'designation'   => $request['designation'],
                'business_name' => $request['business_name'],
                'phone'         => $request['phone'],
                'email'         => $request['email'],
                'address'       => $request['address'],
                'ntn'           => $request['ntn'],
                'strn'          => $request['strn'],
                'record_by'     => auth()->id(),
            ]);
            
            session()->flash('success','Record entered successfully.');
            return redirect()->route('customers.index');
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        session()->flash('error','This option is temporarily blocked by developer.');
        return redirect()->back();

        if (Gate::allows('isShow')) {
            return view('customers.show');
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        session()->flash('error','This option is temporarily blocked by developer.');
        return redirect()->back();

        session()->flash('error','This option is temporarily blocked by developer.');
        return redirect()->back();

        if (Gate::allows('isEdit')) {
            return view('customers.edit', compact('customer'));
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
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        session()->flash('error','This option is temporarily blocked by developer.');
        return redirect()->back();

        if (Gate::allows('isUpdate')) {
            $request->validate([
                'name'          =>  'required',
                'business_name' =>  'required',
                'phone'         =>  'required',
                'address'       =>  'required',
            ]);
    
            $customer->update([
                'business_id'   => auth()->user()->business_id,
                'name'          => $request['name'],
                'designation'   => $request['designation'],
                'business_name' => $request['business_name'],
                'phone'         => $request['phone'],
                'email'         => $request['email'],
                'address'       => $request['address'],
                'ntn'           => $request['ntn'],
                'strn'          => $request['strn'],
                'record_by'     => auth()->id(),
            ]);
            
            session()->flash('success','Record update successfully.');
            return redirect()->route('customers.index');
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        session()->flash('error','This option is temporarily blocked by developer.');
        return redirect()->back();

        if (Gate::allows('isDestroy')) {
            // $customer->delete();
            session()->flash('success','Record removed successfully.');
            return redirect()->route('customers.index');
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }

    public function is_available($id)
    {
        if (Gate::allows('isAvailable')) {
            $result = Customer::findOrFail($id);
            $result->update([
                'is_available' => $result->is_available == 0 ? 1 : 0,
                'record_by' => auth()->id()
            ]);
            session()->flash('success','Status update successfully.');
            return redirect()->route('customers.index');
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }
}
