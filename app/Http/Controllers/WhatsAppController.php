<?php

namespace App\Http\Controllers;

use App\Models\WhatsApp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class WhatsAppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::allows('isIndex')) {
            $whatsapps = WhatsApp::where('business_id','=',auth()->user()->business_id)->orderBy('id', 'DESC')->get();
            // passing data into view
            return view('whatsapp.index', compact('whatsapps'));
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
            return view('whatsapp.create');
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
                'number'      =>  'required',
                'message'     =>  'required|max:155',
            ]);

            WhatsApp::create([
                'business_id'     => auth()->user()->business_id,
                'number'          => $request['number'],
                'message'         => $request['message'],
                'record_by'       => auth()->id(),
            ]);

            return redirect()->away('https://api.whatsapp.com/send?phone='.$request['number'].'&text='.$request['message'].'&source=&data=');
            session()->flash('success','Record entered successfully.');
            return redirect()->route('whatsapp.index');
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WhatsApp  $whatsApp
     * @return \Illuminate\Http\Response
     */
    public function show(WhatsApp $whatsApp)
    {
        if (Gate::allows('isShow')) {
            return view('whatsapp.show');
        }
        else {
            session()->flash('error','This action is unauthorized.');
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WhatsApp  $whatsApp
     * @return \Illuminate\Http\Response
     */
    public function edit(WhatsApp $whatsApp)
    {
        if (Gate::allows('isEdit')) {
            return view('whatsapp.edit', compact('sms'));
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
     * @param  \App\Models\WhatsApp  $whatsApp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WhatsApp $whatsApp)
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
                $url = "https://sendpk.com/api/whatsapp.php?api_key=".config('app.sms_api_key',false);
                $ch = curl_init();
                $timeout = 30; // set to zero for no timeout
                curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)');
                curl_setopt($ch, CURLOPT_URL,$url);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS,$post);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
                $sms = curl_exec($ch);

                WhatsApp::create([
                    'business_id'     => auth()->user()->business_id,
                    'number'          => $request['number'],
                    'message'         => $request['message'],
                    'result'          => $sms,
                    'record_by'       => auth()->id(),
                ]);

                session()->flash('success','Record entered successfully.');
                return redirect()->route('whatsapp.index');
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
     * @param  \App\Models\WhatsApp  $whatsApp
     * @return \Illuminate\Http\Response
     */
    public function destroy(WhatsApp $whatsApp)
    {
        //
    }
}
