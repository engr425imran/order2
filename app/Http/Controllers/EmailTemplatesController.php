<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\EmailTemplate;
use App\Smtp;

class EmailTemplatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data["title"] = "Email Template Management";
        $data["templates"] = EmailTemplate::all();
        $data["smtp"] = Smtp::where('smtp_id', 1)->get();
        $data['words'] = EmailTemplate::select('id','body','title')->where('word_template', true)->get();
        $data['words_default'] = DB::table('email_templates_default')->get();
        return view('pages.emailtemplate', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => ['required', 'string', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'sender' => ['required', 'email'],
            'body' => ['required']
        ]);
        
        $attach_invoice = false;
        $embed_invoice = false;
        $word_template = false;

        if($request->input('attach_invoice') == 'on'){
            $attach_invoice = true;
        }
        if($request->input('embed_invoice') == 'on'){
            $embed_invoice = true;
        }
        if($request->input('word_template') == 'on'){
            $word_template = true;
        }


        $create = EmailTemplate::create([
            'title'  => $request->input('title'),
            'subject'  => $request->input('subject'),
            'sender' => $request->input('sender'),
            'body' => $request->input('body'),
            'attach_invoice' => $attach_invoice,
            'embed_invoice' => $embed_invoice,
            'word_template' => $word_template
        ]);

        if($create)
            return response()->json(array('success' => true, 'msg' => 'New Email Template Created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $id = $request->input('id');
        $data['data'] = array();
        if(EmailTemplate::where('id',$id)->exists()){
            $data['template'] = EmailTemplate::find($id);
        }else{
            $data['template'] = DB::table('email_templates_default')->where('id',$id)->first();
        }
        
        return response()->json(array('data' => $data));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request,[
            'title' => ['required', 'string', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'sender' => ['required', 'email'],
            'body' => ['required']
        ]);
        
        $attach_invoice = false;
        $embed_invoice = false;
        $word_template = false;

        if($request->input('attach_invoice') == 'on'){
            $attach_invoice = true;
        }
        if($request->input('embed_invoice') == 'on'){
            $embed_invoice = true;
        }
        if($request->input('word_template') == 'on'){
            $word_template = true;
        }

        $id = $request->input('id');

        $template = EmailTemplate::find($id);
        $template->title = $request->input('title');
        $template->subject = $request->input('subject');
        $template->sender = $request->input('sender');
        $template->body = $request->input('body');
        $template->attach_invoice = $attach_invoice;
        $template->embed_invoice = $embed_invoice;
        $template->word_template = $word_template;
        
        $template->save();


        if($template)
            return response()->json(array('success' => true, 'msg' => 'Template Updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->input('id');

        $delete = EmailTemplate::find($id)->delete();

        if($delete)
            return response()->json(array('success' => true, 'msg' => 'Template Deleted'));
    }
}
