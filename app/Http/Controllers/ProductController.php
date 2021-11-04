<?php

namespace App\Http\Controllers;

use PDF;
use Session;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Account;
use App\Models\Badge;
use App\Models\Unit;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\File;


class ProductController extends Controller
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
            $products = Product::where('business_id','=',auth()->user()->business_id)->orderBy('id', 'ASC')->get();
            // passing data into view
            return view('products.index', compact('products'));
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }

    public function catalogue($id)
    {
        if (Gate::allows('isShow')) {
            if ($id == 1) {
                $catelogue = "Wholesale Catelogue";
                $products = Product::where('business_id','=',auth()->user()->business_id)->where('is_available',true)->orderBy('id', 'ASC')->get();
                return view('products.catalogue', compact('products','catelogue'));
            }
            elseif ($id == 2) {
                $catelogue = "Retail Catelogue";
                $products = Product::where('business_id','=',auth()->user()->business_id)->where('is_available',true)->orderBy('id', 'ASC')->get();
                return view('products.catalogue', compact('products','catelogue'));
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

    public function pricing()
    {
        if (Gate::allows('isShow')) {
            $products = Product::where('business_id','=',auth()->user()->business_id)->orderBy('category_id', 'ASC')->get();
            $units    = Unit::where('business_id','=',auth()->user()->business_id)->where('is_available','=',true)->get();
            return view('products.pricing', compact('products','units'));
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
            $sku        = Product::count();
            $categories = Category::where('business_id','=',auth()->user()->business_id)->where('is_available','=',true)->get();
            $units      = Unit::where('business_id','=',auth()->user()->business_id)->where('is_available','=',true)->get();
            $badges     = Badge::where('business_id','=',auth()->user()->business_id)->where('is_available','=',true)->get();
            $suppliers  = Supplier::where('business_id','=',auth()->user()->business_id)->where('is_available','=',true)->get();
            $accounts   = Account::where('business_id','=',auth()->user()->business_id)->where('is_available','=',true)->get();
            return view('products.create', compact('sku','categories','units','badges','suppliers','accounts'));
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
        // return $request->all();
        if (Gate::allows('isStore')) {
            $request->validate([
                'image'          =>  'mimes:jpeg,png,jpg|max:100',
                'sku'            =>  'required|unique:products,sku',
                'name'           =>  'required',
                'name_ru'        =>  'required',
                'name_ur'        =>  'required',
                // 'type'           =>  'required',
                // 'badge_id'       =>  'required',
                'category_id'    =>  'required',
                'unit_id'        =>  'required',
                'supplier_id'    =>  'required',
                'account_id'     =>  'required',
                'purchase'       =>  'numeric|min:0|required',
                'sale'           =>  'numeric|min:0|required',
                'discount'       =>  'numeric|min:0|required',
                'purchased_unit' =>  'required',
                'purchased_qty'  =>  'numeric|min:0|required',
            ]);

                
            // -------------- Image --------------
            if ($files = $request->file('image')) {
                $destinationPath = 'assets/attachment/product'; // upload path
                $image = $request['sku']."-".time().".".$files->getClientOriginalExtension();
                // $size = $files->getSize();
                // $miem = $files->getClientOriginalExtension();
                $files->move($destinationPath, $image);
                // $attachment = $destinationPath."/".$image;
            }
            else {
                $image = "default.png";
            }

            $product = Product::create([
                'business_id'     => auth()->user()->business_id,
                'image'           => $image,
                'sku'             => $request['sku'],
                'name'            => $request['name'],
                'name_ru'         => $request['name_ru'],
                'name_ur'         => $request['name_ur'],
                'type'            => $request['type'],
                'category_id'     => $request['category_id'],
                'unit_id'         => $request['unit_id'],
                'supplier_id'     => $request['supplier_id'],
                'account_id'      => $request['account_id'],
                'badge_id'        => $request['badge_id'],
                'purchase'        => $request['purchase'],
                'purchased_qty'   => $request['purchased_qty'],
                'purchased_unit'  => $request['purchased_unit'],
                'sale'            => $request['sale'],
                'discount'        => $request['discount'],
                'dated'           => time(),
                'is_highlight'    => $request['is_highlight'],
                'is_available'    => $request['is_available'],
                'description'     => $request['description'],
                'note'            => $request['note'],
                'record_by'       => auth()->id(),
            ]);

            Transaction::create([
                'business_id'     => auth()->user()->business_id,
                'transaction_id'  => $product->id,
                'transaction'     => $product->category->name." - ".$product->sku,
                'description'     => "Purchased ".$product->purchased_qty.$product->unit->name." (".$product->name." - ".$product->name_ru." - ".$product->name_ur.") From ".$product->supplier->name,
                'debit'           => $product->purchase*$product->purchased_qty,
                // 'credit'       => $request['amount'],
                'category'        => "Product - Purchases",
                'record_by'       => auth()->id(),
            ]);


            session()->flash('success','Record entered successfully.');
            return redirect()->route('products.index');
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        if (Gate::allows('isShow')) {
            return view('products.show');
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        if (Gate::allows('isEdit')) {
            $categories  = Category::where('business_id','=',auth()->user()->business_id)->where('is_available','=',true)->get();
            $units       = Unit::where('business_id','=',auth()->user()->business_id)->where('is_available','=',true)->get();
            $badges      = Badge::where('business_id','=',auth()->user()->business_id)->where('is_available','=',true)->get();
            $suppliers   = Supplier::where('business_id','=',auth()->user()->business_id)->where('is_available','=',true)->get();
            $accounts    = Account::where('business_id','=',auth()->user()->business_id)->where('is_available','=',true)->get();
            $transaction = Transaction::where('business_id','=',auth()->user()->business_id)->where('transaction_id', "=", $product->id)
                                       ->where("category", "=", "Product - Purchases")->firstOrFail();
            return view('products.edit', compact('product','categories','units','badges','suppliers','accounts','transaction'));
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
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        if (Gate::allows('isUpdate')) {
            $request->validate([
                'image'          =>  'mimes:jpeg,png,jpg|max:100',
                'sku'            =>  'required',
                'name'           =>  'required',
                'name_ru'        =>  'required',
                'name_ur'        =>  'required',
                // 'type'           =>  'required',
                // 'badge_id'       =>  'required',
                'category_id'    =>  'required',
                'unit_id'        =>  'required',
                'supplier_id'    =>  'required',
                'account_id'     =>  'required',
                'purchase'       =>  'numeric|min:0|required',
                'sale'           =>  'numeric|min:0|required',
                'discount'       =>  'numeric|min:0|required',
                'purchased_unit' =>  'required',
                'purchased_qty'  =>  'numeric|min:0|required',
            ]);

            if ($files = $request->file('image')) {
                $destinationPath = 'assets/attachment/product'; // upload path
                if($request['old_image'] != "default.png") {
                    File::delete($destinationPath."/".$request['old_image']);
                }
                $image = $request['sku']."-".time().".".$files->getClientOriginalExtension();
                // $size = $files->getSize();
                // $miem = $files->getClientOriginalExtension();
                $files->move($destinationPath, $image);
                // $attachment = $destinationPath."/".$image;

                $product->update(['image' => $image, 'record_by' => auth()->id(),]);
            }

            $product->update([
                'business_id'     => auth()->user()->business_id,
                'name'            => $request['name'],
                'name_ru'         => $request['name_ru'],
                'name_ur'         => $request['name_ur'],
                'type'            => $request['type'],
                'category_id'     => $request['category_id'],
                'unit_id'         => $request['unit_id'],
                'supplier_id'     => $request['supplier_id'],
                'account_id'      => $request['account_id'],
                'badge_id'        => $request['badge_id'],
                'purchase'        => $request['purchase'],
                'purchased_qty'   => $request['purchased_qty'],
                'purchased_unit'  => $request['purchased_unit'],
                'sale'            => $request['sale'],
                'discount'        => $request['discount'],
                'dated'           => time(),
                'is_highlight'    => $request['is_highlight'],
                'is_available'    => $request['is_available'],
                'description'     => $request['description'],
                'note'            => $request['note'],
                'record_by'       => auth()->id(),
            ]);


            // $transaction = Transaction::where('business_id','=',auth()->user()->business_id)
            // ->where('transaction_id', "=", $product->id)->where("category", "=", "Product - Purchases")->last();
            // $transaction->update([
            //     'transaction'     => $product->category->name." - ".$product->sku,
            //     'description'     => "Purchased ".$product->purchased_qty.$product->unit->name." (".$product->name." - ".$product->name_ru." - ".$product->name_ur.") From ".$product->supplier->name,
            //     'debit'           => $product->purchase*$product->purchased_qty,
            //     // 'credit'       => $request['amount'],
            //     'record_by'       => auth()->id(),
            // ]);

            // Transaction::create([
            //     'business_id'     => auth()->user()->business_id,
            //     'transaction_id'  => $product->id,
            //     'transaction'     => $product->category->name." - ".$product->sku,
            //     'description'     => "Purchased ".$product->purchased_qty.$product->unit->name." (".$product->name." - ".$product->name_ru." - ".$product->name_ur.") From ".$product->supplier->name,
            //     'debit'           => $product->purchase*$product->purchased_qty,
            //     // 'credit'       => $request['amount'],
            //     'category'        => "Product - Purchases",
            //     'record_by'       => auth()->id(),
            // ]);

            session()->flash('success','Record update successfully.');

            if ($request['edit_next'] >= 1) {
                Session::put('EDIT-NEXT', 'checked');
                return redirect('products/'.$request['edit_next'].'/edit');
            }
            else {
                Session::forget('EDIT-NEXT');
                return redirect()->route('products.index');
            }
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }

    public function pricing_update(Request $request, Product $product)
    {
        if (Gate::allows('isUpdate')) {
            $request->validate([
                'id'        => 'required',
                'purchase'  => 'required',
                'sale'      => 'required',
        ]);

            $products = Product::where('business_id','=',auth()->user()->business_id)->get();
            foreach ($products as $key => $product)
            {
                if ($request['purchase'][$key] <= 0 && $request['sale'][$key] <= 0 && $request['discount'][$key] <= 0) {
                    $product->update([
                        'unit_id'        =>  $request['unit_id'][$key],
                        'purchased_unit' =>  $request['unit_id'][$key],
                        'purchase'       => 0,
                        'sale'           => 0,
                        'discount'       => 0,
                        'is_available'   => 0,
                        'record_by'      => auth()->id()
                    ]);
                }
                else {
                    $product->update([
                        'unit_id'        =>  $request['unit_id'][$key],
                        'purchased_unit' =>  $request['unit_id'][$key],
                        'purchase'       => $request['purchase'][$key],
                        'sale'           => $request['sale'][$key],
                        'discount'       => $request['discount'][$key],
                        'record_by'      => auth()->id(),
                    ]);
                }
            }

            session()->flash('success','Record update successfully.');
            return redirect()->back();
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if (Gate::allows('isDestroy')) {
            // $product->delete();
            session()->flash('success','Record removed successfully.');
            return redirect()->route('products.index');
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }

    public function is_highlight($id)
    {
        if (Gate::allows('isUpdate')) {
            $result = Product::findOrFail($id);
            $result->update([
                'is_highlight' => $result->is_highlight == 0 ? 1 : 0,
                'record_by' => auth()->id()
            ]);
            session()->flash('success','Product update successfully.');
            return redirect()->route('products.index');
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }

    public function is_available($id)
    {
        if (Gate::allows('isAvailable')) {
            $result = Product::findOrFail($id);
            $result->update([
                'is_available' => $result->is_available == 0 ? 1 : 0,
                'record_by' => auth()->id()
            ]);
            session()->flash('success','Status update successfully.');
            return redirect()->route('products.index');
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }
}
