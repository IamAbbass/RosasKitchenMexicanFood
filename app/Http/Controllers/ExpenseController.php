<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Head;
use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class ExpenseController extends Controller
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
            $expenses = Expense::where('business_id','=',auth()->user()->business_id)->get();
            // passing data into view
            return view('expenses.index', compact('expenses'));
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
            $heads    = Head::where('business_id','=',auth()->user()->business_id)->where('is_available','=',true)->get();
            $accounts = Account::where('business_id','=',auth()->user()->business_id)->where('is_available','=',true)->get();
            return view('expenses.create', compact('heads','accounts'));
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
                'head_id'        =>  'required',
                'account_id'     =>  'required',
                'title'          =>  'required',
                'amount'         =>  'numeric|min:1|required',
                'date'          =>  'required',
                // 'description'    =>  'required',
            ]);
    
            $expense = Expense::create([
                'business_id'   => auth()->user()->business_id,
                'head_id'       => $request['head_id'],
                'account_id'    => $request['account_id'],
                'title'         => $request['title'],
                'amount'        => $request['amount'],
                'description'   => $request['description'],
                'date'          => $request['date'], //$result->is_available == 0 ? 1 : 0
                'record_by'     => auth()->id(),
            ]);

            Transaction::create([
                'business_id'     => auth()->user()->business_id,
                'transaction_id'  => $expense->id,
                'transaction'     => $request['title'],
                'description'     => "Expense From ".$expense->head->name."/".$expense->account->title,
                'debit'           => $request['amount'],
                // 'credit'          => $request['amount'],
                'category'        => "Expenses",
                'record_by'       => auth()->id(),
            ]);
            
            
            session()->flash('success','Record entered successfully.');
            return redirect()->route('expenses.index');
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        if (Gate::allows('isShow')) {
            return view('expenses.show');
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        if (Gate::allows('isEdit')) {
            $heads    = Head::where('business_id','=',auth()->user()->business_id)->where('is_available','=',true)->get();
            $accounts = Account::where('business_id','=',auth()->user()->business_id)->where('is_available','=',true)->get();
            return view('expenses.edit', compact('expense','heads','accounts'));
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
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expense $expense)
    {
        if (Gate::allows('isUpdate')) {
            $request->validate([
                'head_id'        =>  'required',
                'account_id'     =>  'required',
                'title'          =>  'required',
                'amount'         =>  'numeric|min:1|required',
                'date'           =>  'required',
                // 'description'    =>  'required',
            ]);
    
            $expense->update([
                'business_id'   => auth()->user()->business_id,
                'head_id'       => $request['head_id'],
                'account_id'    => $request['account_id'],
                'title'         => $request['title'],
                'amount'        => $request['amount'],
                'description'   => $request['description'],
                'date'          => $request['date'],
                'record_by'     => auth()->id(),
            ]);

            $transaction = Transaction::where('business_id','=',auth()->user()->business_id)
            ->where('transaction_id', "=", $expense->id)->where("category", "=", "Expenses")->firstOrFail();
            $transaction->update([
                'transaction'     => $request['title'],
                'description'     => "Expense From ".$expense->head->name."/".$expense->account->title,
                'debit'           => $request['amount'],
                // 'credit'          => $request['amount'],
                'record_by'       => auth()->id(),
            ]);

            
            session()->flash('success','Record update successfully.');
            return redirect()->route('expenses.index');
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
        if (Gate::allows('isDestroy')) {
            // $expense->delete();
            session()->flash('success','Record removed successfully.');
            return redirect()->route('expenses.index');
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }

    public function is_available($id)
    {
        if (Gate::allows('isAvailable')) {
            $result = Expense::findOrFail($id);
            $result->update([
                'is_available' => $result->is_available == 0 ? 1 : 0,
                'record_by' => auth()->id()
            ]);
            session()->flash('success','Status update successfully.');
            return redirect()->route('expenses.index');
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }
}
