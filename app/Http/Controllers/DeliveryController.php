<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DeliveryController extends Controller
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
            $deliveries = Delivery::where('business_id','=',auth()->user()->business_id)->get();
            // passing data into view
            return view('deliveries.index', compact('deliveries'));
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
            return view('deliveries.create');
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
                'name'                  =>  'required',
                'amount'                =>  'numeric|min:0|required',
                'free_delivery_after'   =>  'numeric|min:0|required',
            ]);
    
            Delivery::create([
                'business_id'           => auth()->user()->business_id,
                'name'                  => $request['name'],
                'amount'                => $request['amount'],
                'free_delivery_after'   => $request['free_delivery_after'],
                'is_available'          => false,
                'record_by'             => auth()->id(),
            ]);
            
            session()->flash('success','Record entered successfully.');
            return redirect()->route('deliveries.index');
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function show(Delivery $delivery)
    {
        if (Gate::allows('isDestroy')) {
            session()->flash('error','This action is unauthorized.');
            return redirect()->route('deliveries.index');
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function edit(Delivery $delivery)
    {
        if (Gate::allows('isEdit')) {
            return view('deliveries.edit', compact('delivery'));
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
     * @param  \App\Models\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Delivery $delivery)
    {
        if (Gate::allows('isUpdate')) {
            $request->validate([
                'name'                  =>  'required',
                'amount'                =>  'numeric|min:0|required',
                'free_delivery_after'   =>  'numeric|min:0|required',
            ]);
    
            $delivery->update([
                'business_id'           => auth()->user()->business_id,
                'name'                  => $request['name'],
                'amount'                => $request['amount'],
                'free_delivery_after'   => $request['free_delivery_after'],
                'record_by'             => auth()->id(),
            ]);
            
            session()->flash('success','Record update successfully.');
            return redirect()->route('deliveries.index');
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Delivery $delivery)
    {
        if (Gate::allows('isDestroy')) {
            session()->flash('error','This action is unauthorized.');
            return redirect()->route('deliveries.index');
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }

    public function is_available(Delivery $id)
    {
        if(Gate::allows('isOwner')) {
            if (Gate::allows('isAvailable')) {
                // Inactive All Deliveries Option
                $deliveries = Delivery::get();
                foreach ($deliveries as $key => $delivery)
                {
                    $delivery->update([
                        'is_available'  => 0,
                        'record_by'     => auth()->id()
                    ]);
                }

                // Active Selected One
                $id->update([
                    'is_available' => 1,
                    'record_by'    => auth()->id()
                ]);
    
                session()->flash('success','Status update successfully.');
                return redirect()->route('deliveries.index');
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
