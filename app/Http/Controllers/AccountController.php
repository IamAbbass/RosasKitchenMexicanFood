<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class AccountController extends Controller
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
            $accounts = Account::where('business_id','=',auth()->user()->business_id)->get();
            // passing data into view
            return view('accounts.index', compact('accounts'));
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
            return view('accounts.create');
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }

    public function deposit()
    {
        if (Gate::allows('isCreate')) {
            $accounts = Account::where('business_id','=',auth()->user()->business_id)->get();
            // passing data into view
            return view('accounts.deposit', compact('accounts'));
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
                'title'             =>  'required|unique:accounts,title',
                'type'              =>  'required',
                'amount'            =>  'numeric|min:0|required',
            ]);
    
            $account = Account::create([
                'business_id'     => auth()->user()->business_id,
                'title'           => $request['title'],
                'type'            => $request['type'],
                'amount'          => $request['amount'],
                'details'         => $request['details'],
                'record_by'       => auth()->id(),
            ]);

            Transaction::create([
                'business_id'     => auth()->user()->business_id,
                'transaction_id'  => $account->id,
                'transaction'     => "Account Opening - ".$request['type'],
                'description'     => $request['details'],
                // 'debit'           => $request['amount'],
                'credit'          => $request['amount'],
                'category'        => "Account Opening",
                'record_by'       => auth()->id(),
            ]);

            session()->flash('success','Record entered successfully.');
            return redirect()->route('accounts.index');
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }

    public function deposit_store(Request $request)
    {
        if (Gate::allows('isStore')) {
            $request->validate([
                'account'        =>  'required',
                'amount'         =>  'numeric|min:0|required',
                'note'           =>  'required',
            ]);
    
            $account = Account::where('business_id','=',auth()->user()->business_id)
            ->where('id', "=", $request['account'])->firstOrFail();
            Transaction::create([
                'business_id'     => auth()->user()->business_id,
                'transaction_id'  => $request['account'],
                'transaction'     => "Deposit in - ".$account->title." (".$account->type.")",
                'description'     => $request['note'],
                // 'debit'        => $request['amount'],
                'credit'          => $request['amount'],
                'category'        => "Deposit",
                'record_by'       => auth()->id(),
            ]);

            $account->update([
                'amount'          => $account->amount + $request['amount'],
                'record_by'       => auth()->id(),
            ]);

            session()->flash('success','Record entered successfully.');
            return redirect()->route('transactions.index');
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account)
    {
        if (Gate::allows('isShow')) {
            return view('accounts.show');
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function edit(Account $account)
    {
        // if (Gate::allows('isEdit')) {
        //     return view('accounts.edit', compact('account'));
        // }
        // else {
        //     session()->flash('error','This action is unauthorized.');
        //     return redirect()->back();
        // }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Account $account)
    {
        // if (Gate::allows('isUpdate')) {
        //     $request->validate([
        //         'title'             =>  'required|unique:accounts,title',
        //         'type'              =>  'required',
        //         'amount'            =>  'numeric',
        //     ]);
    
        //     $account->update([
        //         'business_id'     => auth()->user()->business_id,
        //         'title'           => $request['title'],
        //         'type'            => $request['type'],
        //         'amount'          => $request['amount'],
        //         'details'         => $request['details'],
        //         'record_by'       => auth()->id(),
        //     ]);
            
        //     session()->flash('success','Record update successfully.');
        //     return redirect()->route('accounts.index');
        // }
        // else {
        //     session()->flash('error','This action is unauthorized.');
        //     return redirect()->back();
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {
        if (Gate::allows('isDestroy')) {
            // $account->delete();
            session()->flash('success','Record removed successfully.');
            return redirect()->route('accounts.index');
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }

    public function is_available($id)
    {
        if (Gate::allows('isAvailable')) {
            $result = Account::findOrFail($id);
            $result->update([
                'is_available' => $result->is_available == 0 ? 1 : 0,
                'record_by' => auth()->id()
            ]);
            session()->flash('success','Status update successfully.');
            return redirect()->route('accounts.index');
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }
}
