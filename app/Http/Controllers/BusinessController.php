<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Business;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class BusinessController extends Controller
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
            if (Gate::allows('isOwner')) {
                $businesses = Business::all();
            }
            else {
                $businesses = Business::where('id','=',auth()->user()->business_id)->get();
            }
            return view('businesses.index', compact('businesses'));
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
        if(Gate::allows('isOwner')) {
            if (Gate::allows('isCreate')) {
                return view('businesses.create');
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Gate::allows('isOwner')) {
            if (Gate::allows('isStore')) {
                $request->validate([
                    'icon'          =>  'mimes:jpeg,png,jpg|max:100',
                    'fcm_icon'      =>  'mimes:jpeg,png,jpg|max:100|dimensions:min_width=148,min_height=158',
                    'image'         =>  'mimes:jpeg,png,jpg|max:100',
                    'fcm_image'     =>  'mimes:jpeg,png,jpg|max:100|dimensions:min_width=500,min_height=270',
                    'name'          =>  'required',
                    'phone'         =>  'required',
                    'website'       =>  'required',
                    'email'         =>  'required|email',
                    'address'       =>  'required',
                    'min_order'     =>  'required|numeric|min:1',
                    'is_gift'       =>  'required',
                    'off_note'      =>  'required',
                ]);
        
                if ($files = $request->file('icon')) {
                    $destinationPath = 'assets/attachment/business'; // upload path
                    $icon = time().".".$files->getClientOriginalExtension();
                    // $size = $files->getSize();
                    // $miem = $files->getClientOriginalExtension();
                    $files->move($destinationPath, $icon);

                    // $image = $destinationPath."/".$image;
                }
                else {
                    $icon = "icon.png";
                }

                if ($files = $request->file('fcm_icon')) {
                    $destinationPath = 'assets/attachment/business'; // upload path
                    $fcm_icon = time().".".$files->getClientOriginalExtension();
                    // $size = $files->getSize();
                    // $miem = $files->getClientOriginalExtension();
                    $files->move($destinationPath, $fcm_icon);

                    // $fcm_icon = $destinationPath."/".$fcm_icon;
                }
                else {
                    $fcm_icon = "fcm_icon.png";
                }

                if ($files = $request->file('image')) {
                    $destinationPath = 'assets/attachment/business'; // upload path
                    $image = time().".".$files->getClientOriginalExtension();
                    // $size = $files->getSize();
                    // $miem = $files->getClientOriginalExtension();
                    $files->move($destinationPath, $image);

                    // $image = $destinationPath."/".$image;
                }
                else {
                    $image = "image.png";
                }

                if ($files = $request->file('fcm_image')) {
                    $destinationPath = 'assets/attachment/business'; // upload path
                    $fcm_image = time().".".$files->getClientOriginalExtension();
                    // $size = $files->getSize();
                    // $miem = $files->getClientOriginalExtension();
                    $files->move($destinationPath, $fcm_image);

                    // $fcm_image = $destinationPath."/".$fcm_image;
                }
                else {
                    $fcm_image = "fcm_image.png";
                }

                $business_id = Business::create([
                    'icon'          => $icon,
                    'fcm_icon'      => $icon,
                    'image'         => $fcm_image,
                    'fcm_image'     => $fcm_image,
                    'name'          => $request['name'],
                    'slogan'        => $request['slogan'],
                    'phone'         => $request['phone'],
                    'website'       => $request['website'],
                    'email'         => $request['email'],
                    'address'       => $request['address'],

                    'facebook'      => $request['facebook'],
                    'instagram'     => $request['instagram'],
                    'youtube'       => $request['youtube'],
                    'twitter'       => $request['twitter'],

                    'ntn'           => $request['ntn'],
                    'strn'          => $request['strn'],
                    'min_order'     => $request['min_order'],
                    'is_gift'       => $request['is_gift'],
                    'off_note'      => $request['off_note'],
                    'record_by'     => auth()->id(),
                ]);

    
                //Business Owner
                //Creating default role
                $role_id = Role::create([
                    'permission'    => "Admin",
                    'title'         => "Full Access",
                    'index'         => true,
                    'create'        => true,
                    'store'         => true,
                    'show'          => true,
                    'edit'          => true,
                    'update'        => true,
                    'destroy'       => true,
                    'is_available'  => true,
                    'record_by'     => auth()->id(),
                ]);
        
    
                $user['business_id'] = $business_id->id;
                $user['customer_id'] = 0;
                $user['api_token']   = hash('sha256', Str::random(60));
                $user['role_id']     = $role_id->id;
                $user['name']        = $request['name'];
                $user['phone']       = $request['phone'];
                $user['email']       = $request['email'];
                $user['password']    = Hash::make("123456789");
                $user['address']     = $request['address'];
                $user['is_available']      = true;
                $user['record_by']   = auth()->id();
                User::create($user);
                
                session()->flash('success','New  business created successfully, (Email: '.$request['email'].' & Password: 123456789)');
                return redirect()->route('businesses.index');
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function show(Business $business)
    {
        if(Gate::allows('isOwner')) {
            if (Gate::allows('isShow')) {
                return view('businesses.show');
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function edit(Business $business)
    {
        if(Gate::allows('isOwner')) {
            if (Gate::allows('isEdit')) {
                return view('businesses.edit', compact('business'));
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Business $business)
    {
        if(Gate::allows('isOwner')) {
            if (Gate::allows('isUpdate')) {
                $request->validate([
                    'icon'          =>  'mimes:jpeg,png,jpg|max:100',
                    'fcm_icon'      =>  'mimes:jpeg,png,jpg|max:100|dimensions:min_width=148,min_height=158',
                    'image'         =>  'mimes:jpeg,png,jpg|max:100',
                    'fcm_image'     =>  'mimes:jpeg,png,jpg|max:100|dimensions:min_width=500,min_height=270',
                    'name'          =>  'required',
                    'phone'         =>  'required',
                    'website'       =>  'required',
                    'email'         =>  'required|email',
                    'address'       =>  'required',
                    'min_order'     =>  'required|numeric|min:1',
                    'is_gift'       =>  'required',
                    'off_note'      =>  'required',
                ]);
        
                if ($files = $request->file('icon')) {
                    $destinationPath = 'assets/attachment/business'; // upload path
                    if($request['old_icon'] != "icon.png") {
                        File::delete($destinationPath."/".$request['old_icon']);
                    }
                    $icon = time().".".$files->getClientOriginalExtension();
                    $files->move($destinationPath, $icon);
                    // $image = $destinationPath."/".$image;
                }
                else {
                    $icon = $business->icon;
                }    

                if ($files = $request->file('fcm_icon')) {
                    $destinationPath = 'assets/attachment/business'; // upload path
                    if($request['old_fcm_icon'] != "fcm_icon.png") {
                        File::delete($destinationPath."/".$request['old_fcm_icon']);
                    }
                    $fcm_icon = time().".".$files->getClientOriginalExtension();
                    $files->move($destinationPath, $fcm_icon);
                    // $image = $destinationPath."/".$image;
                }
                else {
                    $fcm_icon = $business->fcm_icon;
                }    

                if ($files = $request->file('image')) {
                    $destinationPath = 'assets/attachment/business'; // upload path
                    if($request['old_image'] != "image.png") {
                        File::delete($destinationPath."/".$request['old_image']);
                    }
                    $image = time().".".$files->getClientOriginalExtension();
                    $files->move($destinationPath, $image);

                    // $image = $destinationPath."/".$image;
                }
                else {
                    $image = $business->image;
                }    

                if ($files = $request->file('fcm_image')) {
                    $destinationPath = 'assets/attachment/business'; // upload path
                    if($request['old_fcm_image'] != "fcm_image.png") {
                        File::delete($destinationPath."/".$request['old_fcm_image']);
                    }
                    $fcm_image = time().".".$files->getClientOriginalExtension();
                    $files->move($destinationPath, $fcm_image);

                    // $image = $destinationPath."/".$image;
                }
                else {
                    $fcm_image = $business->fcm_image;
                }    

                $business->update([
                    'icon'          => $icon,
                    'fcm_icon'      => $fcm_icon,
                    'image'         => $image,
                    'fcm_image'     => $fcm_image,
                    'name'          => $request['name'],
                    'slogan'        => $request['slogan'],
                    'phone'         => $request['phone'],
                    'website'         => $request['website'],
                    'email'         => $request['email'],
                    'address'       => $request['address'],

                    'facebook'      => $request['facebook'],
                    'instagram'     => $request['instagram'],
                    'youtube'       => $request['youtube'],
                    'twitter'       => $request['twitter'],

                    'ntn'           => $request['ntn'],
                    'strn'          => $request['strn'],
                    'min_order'     => $request['min_order'],
                    'is_gift'       => $request['is_gift'],
                    'off_note'      => $request['off_note'],
                    'record_by'     => auth()->id()
                ]);
                
                session()->flash('success','Record update successfully.');
                return redirect()->route('businesses.index');
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function destroy(Business $business)
    {
        if(Gate::allows('isOwner')) {
            if (Gate::allows('isDestroy')) {
                // $business->delete();
                session()->flash('success','Record removed successfully.');
                return redirect()->route('businesses.index');
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

    public function is_available($id)
    {
        if(Gate::allows('isOwner')) {
            if (Gate::allows('isAvailable')) {
                $result = Business::findOrFail($id);
                $result->update([
                    'is_available' => $result->is_available == 0 ? 1 : 0,
                    'record_by' => auth()->id()
                ]);
    
                session()->flash('success','Status update successfully.');
                return redirect()->route('businesses.index');
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
