<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
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
            $categories = Category::where('business_id','=',auth()->user()->business_id)->get();
            // passing data into view
            return view('categories.index', compact('categories'));
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
            $categories = Category::where('business_id','=',auth()->user()->business_id)->where('sub_id','>',0)->get();
            return view('categories.create', compact('categories'));
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
                'image'       =>  'required',
                'sub_id'      =>  'required',
                'name'        =>  'required|unique:categories,name',
            ]);
    
            Category::create([
                'business_id'   => auth()->user()->business_id,
                'image'         => $request['image'],
                'name'          => $request['name'],
                'sub_id'        => $request['sub_id'],
                'record_by'     => auth()->id(),
            ]);
            
            session()->flash('success','Record entered successfully.');
            return redirect()->route('categories.index');
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        if (Gate::allows('isShow')) {
            return view('categories.show');
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        if (Gate::allows('isEdit')) {
            $categories = Category::where('business_id','=',auth()->user()->business_id)->where('sub_id','>',0)->get();
            return view('categories.edit', compact('categories','category'));
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
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        if (Gate::allows('isUpdate')) {
            $request->validate([
                'image'       =>  'required',
                'sub_id'      =>  'required',
                'name'        =>  'required|unique:categories,name',
            ]);
    
            $category->update([
                'business_id'   => auth()->user()->business_id,
                'image'         => $request['image'],
                'name'          => $request['name'],
                'sub_id'        => $request['sub_id'],
                'record_by'     => auth()->id(),
            ]);
            
            session()->flash('success','Record update successfully.');
            return redirect()->route('categories.index');
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if (Gate::allows('isDestroy')) {
            // $category->delete();
            session()->flash('success','Record removed successfully.');
            return redirect()->route('categories.index');
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
                $result = Category::findOrFail($id);
                $result->update([
                    'is_available' => $result->is_available == 0 ? 1 : 0,
                    'record_by' => auth()->id()
                ]);
    
                session()->flash('success','Status update successfully.');
                return redirect()->route('categories.index');
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
