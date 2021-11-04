<?php

namespace App\Http\Controllers;

use App\Models\Fcm;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class FcmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::allows('isIndex')) {
            $fcms = Fcm::where('business_id','=',auth()->user()->business_id)->orderBy('id', 'DESC')->get();
            // passing data into view
            return view('fcm.index', compact('fcms'));
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
            return view('fcm.create');
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
            if (config('app.ROZA_notification',false) == true) {
                $request->validate([
                    'title'           =>  'required|max:40',
                    'description'     =>  'required|max:50',
                ]);

                $customers = Customer::where('business_id','=',auth()->user()->business_id)->where('is_available','=',true)->get();
                foreach($customers as $index => $customer) {
                    // $fcm_token  = $customer->fcm_token;
                    $data = array(
                        "to" => $customer->fcm_token,
                        "notification" => array(
                            'title' => $request['title'],
                            'body'  => $request['description'],
                            'color' => '#99e265',
                            'icon'  => auth()->user()->business->fcm_icon,
                            'image' => auth()->user()->business->fcm_image,
                            'click_action' => auth()->user()->business->website,
                        ));
                        $data_string = json_encode($data);
                        //return "The Json Data : ".$data_string;
                        $headers = array ( 'Authorization: key='.config('app.firebase_server_key',false), 'Content-Type: application/json' );
                        $ch = curl_init(); curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        
                        curl_setopt( $ch,CURLOPT_POST, true );
                        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
                        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
                        curl_setopt( $ch,CURLOPT_POSTFIELDS, $data_string);
                        $notification = curl_exec($ch);
                        curl_close ($ch);
                        // return $notification;
                }

                $fcm = Fcm::create([
                    'business_id'     => auth()->user()->business_id,
                    'title'           => $request['title'],
                    'description'     => $request['description'],
                    'record_by'       => auth()->id(),
                ]);

                session()->flash('success','Record entered successfully.');
                return redirect()->route('fcm.index');
            }
            else {
                session()->flash('error','FCM is set as false (.env).');
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
     * @param  \App\Models\Fcm  $fcm
     * @return \Illuminate\Http\Response
     */
    public function show(Fcm $fcm)
    {
        if (Gate::allows('isShow')) {
            return view('fcm.show');
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fcm  $fcm
     * @return \Illuminate\Http\Response
     */
    public function edit(Fcm $fcm)
    {
        if (Gate::allows('isEdit')) {
            return view('fcm.edit', compact('fcm'));
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
     * @param  \App\Models\Fcm  $fcm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fcm $fcm)
    {
        // return $request->all();
        if (Gate::allows('isUpdate')) {
            if (config('app.ROZA_notification',false) == true) {
                $request->validate([
                    'title'           =>  'required|max:40',
                    'description'     =>  'required|max:50',
                ]);

                $customers = Customer::where('business_id','=',auth()->user()->business_id)->where('is_available','=',true)->get();
                foreach($customers as $index => $customer) {
                    // $fcm_token  = $customer->fcm_token;
                    $data = array(
                        "to" => $customer->fcm_token,
                        "notification" => array(
                            'title' => $fcm->title,
                            'body'  => $fcm->description,
                            'color' => '#99e265',
                            'icon'  => auth()->user()->business->fcm_icon,
                            'image' => auth()->user()->business->fcm_image,
                            'click_action' => auth()->user()->business->website,
                        ));
                        $data_string = json_encode($data);
                        //return "The Json Data : ".$data_string;
                        $headers = array ( 'Authorization: key='.config('app.firebase_server_key',false), 'Content-Type: application/json' );
                        $ch = curl_init(); curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        
                        curl_setopt( $ch,CURLOPT_POST, true );
                        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
                        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
                        curl_setopt( $ch,CURLOPT_POSTFIELDS, $data_string);
                        $notification = curl_exec($ch);
                        curl_close ($ch);
                        // return $notification;
                }

                $fcm = Fcm::create([
                    'business_id'     => auth()->user()->business_id,
                    'title'           => $request['title'],
                    'description'     => $request['description'],
                    'record_by'       => auth()->id(),
                ]);

                session()->flash('success','Record entered successfully.');
                return redirect()->route('fcm.index');
            }
            else {
                session()->flash('error','FCM is set as false (.env).');
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
     * @param  \App\Models\Fcm  $fcm
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fcm $fcm)
    {
        //
    }
}
