<?php

namespace App\Http\Controllers;

use App\Models\Fix;
use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class FixController extends Controller
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
            $fixes = Fix::where('business_id','=',auth()->user()->business_id)->get();
            // passing data into view
            return view('fixes.index', compact('fixes'));
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
            $accounts = Account::where('business_id','=',auth()->user()->business_id)->where('is_available','=',true)->get();
            return view('fixes.create', compact('accounts'));
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
                'account_id'     =>  'required',
                'title'          =>  'required',
                'amount'         =>  'numeric|min:1|required',
                'date'           =>  'required',
                // 'description'    =>  'required',
            ]);
    
            $fix = Fix::create([
                'business_id'   => auth()->user()->business_id,
                'account_id'    => $request['account_id'],
                'title'         => $request['title'],
                'amount'        => $request['amount'],
                'description'   => $request['description'],
                'date'          => $request['date'], //$result->is_available == 0 ? 1 : 0
                'record_by'     => auth()->id(),
            ]);

            Transaction::create([
                'business_id'     => auth()->user()->business_id,
                'transaction_id'  => $fix->id,
                'transaction'     => $request['title'],
                'description'     => "Purchased Assets From ".$fix->account->title,
                'debit'           => $request['amount'],
                // 'credit'       => $request['amount'],
                'category'        => "Fixed Assets",
                'record_by'       => auth()->id(),
            ]);

            session()->flash('success','Record entered successfully.');
            return redirect()->route('fixes.index');
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fix  $fix
     * @return \Illuminate\Http\Response
     */
    public function show(Fix $fix)
    {
        if (Gate::allows('isShow')) {
            return view('fixes.show');
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fix  $fix
     * @return \Illuminate\Http\Response
     */
    public function edit(Fix $fix)
    {
        if (Gate::allows('isEdit')) {
            $accounts = Account::where('business_id','=',auth()->user()->business_id)->where('is_available','=',true)->get();
            return view('fixes.edit', compact('fix','accounts'));
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
     * @param  \App\Models\Fix  $fix
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fix $fix)
    {
        if (Gate::allows('isUpdate')) {
            $request->validate([
                'account_id'     =>  'required',
                'title'          =>  'required',
                'amount'         =>  'numeric|min:1|required',
                'date'           =>  'required',
                // 'description'    =>  'required',
            ]);
    
            $fix->update([
                'business_id'   => auth()->user()->business_id,
                'account_id'    => $request['account_id'],
                'title'         => $request['title'],
                'amount'        => $request['amount'],
                'description'   => $request['description'],
                'date'          => $request['date'],
                'record_by'     => auth()->id(),
            ]);

            $transaction = Transaction::where('business_id','=',auth()->user()->business_id)
            ->where('transaction_id', "=", $fix->id)->where("category", "=", "Fixed Assets")->firstOrFail();
            $transaction->update([
                'transaction'     => $request['title'],
                'description'     => "Fixed Assets From ".$fix->account->title,
                'debit'           => $request['amount'],
                // 'credit'          => $request['amount'],
                'record_by'       => auth()->id(),
            ]);

            
            session()->flash('success','Record update successfully.');
            return redirect()->route('fixes.index');
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fix  $fix
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fix $fix)
    {
        if (Gate::allows('isDestroy')) {
            // $fix->delete();
            session()->flash('success','Record removed successfully.');
            return redirect()->route('fixes.index');
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }

    public function is_available($id)
    {
        if (Gate::allows('isAvailable')) {
            $result = Fix::findOrFail($id);
            $result->update([
                'is_available' => $result->is_available == 0 ? 1 : 0,
                'record_by' => auth()->id()
            ]);
            session()->flash('success','Status update successfully.');
            return redirect()->route('fixes.index');
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }
}
