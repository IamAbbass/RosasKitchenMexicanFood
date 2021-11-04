<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Role;

class UserController extends Controller
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
        if (Gate::allows('isOwner')  || Gate::allows('isAdmin') && Gate::allows('isIndex')) {
            // $users = User::where('business_id','=',auth()->user()->business_id)->get();
            $users = User::orderBy('customer_id', 'ASC')->orderBy('is_verified', 'DESC')->get();
            
            return view('users.index', compact('users'));
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
        if (Gate::allows('isOwner')  || Gate::allows('isAdmin') && Gate::allows('isCreate')) {
            return view('users.create');
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
        if (Gate::allows('isOwner')  || Gate::allows('isAdmin') && Gate::allows('isStore')) {
          $user = $request->validate([
              'name'          =>  'required',
              'email'         => ['required', 'string', 'email', 'max:255', 'unique:users'],
              'password'      => ['required', 'string', 'min:8'],
              'phone'         =>  'required',
          ]);

          //Creating default role
          $role_id = Role::create([
              'record_by' => auth()->id(),
          ]);

          $user['business_id'] = auth()->user()->business_id; //$request->business_id;
          $user['customer_id'] = 0;
          $user['api_token']   = hash('sha256', Str::random(60));
          $user['role_id']     = $role_id->id;
          $user['record_by']   = auth()->id();
          $user['password']    = Hash::make($request->password);
          $user['address']     = $request->address;
          $user['is_verified'] = true;

          User::create($user);

          session()->flash('success','Record entered successfully.');
          return redirect()->route('users.index');
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        if (Gate::allows('isOwner')  || Gate::allows('isAdmin') || Gate::allows('isManager') && Gate::allows('isShow')) {
            return view('users.show');
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($user) //edit(User $user)
    {
      if (Gate::allows('isOwner')  || Gate::allows('isAdmin') || Gate::allows('isManager') && Gate::allows('isEdit')) {
            $user = User::where('business_id','=',auth()->user()->business_id)->findOrFail($user);
            return view('users.edit', compact('user'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Gate::allows('isOwner')  || Gate::allows('isAdmin') || Gate::allows('isManager') && Gate::allows('isUpdate')) {
          $request->validate([
              'name'      => 'required',
              'email'     => 'required|unique:users,email,'.$id,
              'phone'     => 'required',
              'title'     => 'required',
          ]);

          $user = User::where('business_id','=',auth()->user()->business_id)->findOrFail($id);
          if (request()->filled('password')){
              $user->update([
                  'image'         => $request['image'],
                  'name'          => $request['name'],
                  'email'         => $request['email'],
                  'phone'         => $request['phone'],
                  'password'      => Hash::make($request['password']),
                  'address'       => $request['address'],
                  'record_by'     => auth()->id(),
              ]);
          }
          else {
              $user->update([
                  'image'         => $request['image'],
                  'name'          => $request['name'],
                  'email'         => $request['email'],
                  'phone'         => $request['phone'],
                  'address'       => $request['address'],
                  'record_by'     => auth()->id(),
              ]);
          }

        $user->role->update([
            'permission'    => $request['permission'],
            'title'         => $request['title'],
            'index'         => $request['index']  == 1 ? 1 : 0,
            'create'        => $request['create']  == 1 ? 1 : 0,
            'store'         => $request['store']   == 1 ? 1 : 0,
            'show'          => $request['show']    == 1 ? 1 : 0,
            'edit'          => $request['edit']    == 1 ? 1 : 0,
            'update'        => $request['update']  == 1 ? 1 : 0,
            'destroy'       => $request['destroy'] == 1 ? 1 : 0,
            'is_available'  => $request['is_available']  == 1 ? 1 : 0,
            'record_by'     => auth()->id(),
        ]);

          session()->flash('success','Record update successfully.');
          return redirect()->route('users.index');
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }

    public function profile($id)
    {
      if (Gate::allows('isOwner')  || Gate::allows('isAdmin') || Gate::allows('isManager') && Gate::allows('isEdit')) {
            $user = User::where('business_id','=',auth()->user()->business_id)->findOrFail($id);
            return view('users.profile', compact('user'));
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }

    public function profile_update(Request $request, $id)
    {
        if (Gate::allows('isOwner')  || Gate::allows('isAdmin') || Gate::allows('isManager') && Gate::allows('isUpdate')) {
            $request->validate([
                'name'      => 'required',
                'email'     => 'required|email',
                'phone'     => 'required',
                'address'   => 'required',
            ]);

            $user = User::where('business_id','=',auth()->user()->business_id)->findOrFail($id);
            if (request()->filled('password')){
                $request->validate([
                    'password'  => ['required', 'string', 'min:8', 'confirmed'],
                ]);
    
                $user->update([
                    'image'         => $request['image'],
                    'name'          => $request['name'],
                    'email'         => $request['email'],
                    'phone'         => $request['phone'],
                    'password'      => Hash::make($request['password']),
                    'address'       => $request['address'],
                    'record_by'     => auth()->id(),
                ]);
            }
            else {
                $user->update([
                    'image'         => $request['image'],
                    'name'          => $request['name'],
                    'email'         => $request['email'],
                    'phone'         => $request['phone'],
                    'address'       => $request['address'],
                    'record_by'     => auth()->id(),
                ]);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      if (Gate::allows('isOwner')  || Gate::allows('isAdmin') || Gate::allows('isManager') && Gate::allows('isDestroy')) {
            $result = User::where('business_id','=',auth()->user()->business_id)->findOrFail($id);
            // $result->delete();
            session()->flash('success','Record removed successfully.');
            return redirect()->route('users.index');
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }

    public function is_available($id)
    {
        if (Gate::allows('isOwner')  || Gate::allows('isAdmin') || Gate::allows('isManager') && Gate::allows('isAvailable')) {
          $result = User::where('business_id','=',auth()->user()->business_id)->findOrFail($id);
          $result->update([
              'is_available' => $result->is_available == 0 ? 1 : 0,
              'record_by' => auth()->id()
          ]);
          session()->flash('success','Status update successfully.');
          return redirect()->route('users.index');
        }
        else  {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }
}
