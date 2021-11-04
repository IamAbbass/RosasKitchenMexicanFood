<?php

namespace App\Http\Controllers;

use App\Models\Sms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class SmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::allows('isIndex')) {
            $smss = Sms::where('business_id','=',auth()->user()->business_id)->orderBy('id', 'DESC')->get();
            // passing data into view
            return view('sms.index', compact('smss'));
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
            return view('sms.create');
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
            if(config('app.sabzify_sms',false) == true) {
                $request->validate([
                    'number'      =>  'required',
                    'message'     =>  'required|max:155',
                ]);

                $sender = "SABZIFY";
                $post = "sender=".urlencode($sender)."&mobile=".urlencode($request['number'])."&message=".urlencode($request['message'])."";
                $url = "https://sendpk.com/api/sms.php?api_key=".config('app.sms_api_key',false);
                $ch = curl_init();
                $timeout = 30; // set to zero for no timeout
                curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)');
                curl_setopt($ch, CURLOPT_URL,$url);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS,$post);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
                $sms = curl_exec($ch);

                Sms::create([
                    'business_id'     => auth()->user()->business_id,
                    'number'          => $request['number'],
                    'message'         => $request['message'],
                    'result'          => $sms,
                    'record_by'       => auth()->id(),
                ]);

                session()->flash('success','Record entered successfully.');
                return redirect()->route('sms.index');
            }
            else {
                session()->flash('error','SMS is set as false (.env).');
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
     * @param  \App\Models\Sms  $sms
     * @return \Illuminate\Http\Response
     */
    public function show(Sms $sms)
    {
        if (Gate::allows('isShow')) {
            return view('sms.show');
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sms  $sms
     * @return \Illuminate\Http\Response
     */
    public function edit(Sms $sms)
    {
        if (Gate::allows('isEdit')) {
            return view('sms.edit', compact('sms'));
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
     * @param  \App\Models\Sms  $sms
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sms $sms)
    {
        // return $request->all();
        if (Gate::allows('isUpdate')) {
            if(config('app.sabzify_sms',false) == true) {
                $request->validate([
                    'number'      =>  'required',
                    'message'     =>  'required|max:155',
                ]);

                $sender = "SABZIFY";
                $post = "sender=".urlencode($sender)."&mobile=".urlencode($request['number'])."&message=".urlencode($request['message'])."";
                $url = "https://sendpk.com/api/sms.php?api_key=".config('app.sms_api_key',false);
                $ch = curl_init();
                $timeout = 30; // set to zero for no timeout
                curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)');
                curl_setopt($ch, CURLOPT_URL,$url);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS,$post);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
                $sms = curl_exec($ch);

                Sms::create([
                    'business_id'     => auth()->user()->business_id,
                    'number'          => $request['number'],
                    'message'         => $request['message'],
                    'result'          => $sms,
                    'record_by'       => auth()->id(),
                ]);

                session()->flash('success','Record entered successfully.');
                return redirect()->route('sms.index');
            }
            else {
                session()->flash('error','Sms is set as false (.env).');
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
     * @param  \App\Models\Sms  $sms
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sms $sms)
    {
        //
    }
}
