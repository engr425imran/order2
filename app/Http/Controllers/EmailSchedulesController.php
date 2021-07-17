<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EmailTemplate;
use App\EmailSchedule;
use App\Invoice;
use App\Customer;

use DB;

class EmailSchedulesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data["title"] = "Email Schedules";
        $data["schedules"] = EmailSchedule::all();

        //return response()->json($data);
        return view('pages.emailschedules', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($invoice_ids)
    {
        
        $data["title"] = "Email Scheduler";
        $data["templates"] = EmailTemplate::all();
        $data["invoice_ids"] = $invoice_ids;

        return view('pages.addemailschedule', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        

        // $create = EmailSchedule::create([
        //     'template_id'  => $request->input('template_id'),
        //     'invoice_id'  => $request->input('invoice_id'),
        //     'days' => $request->input('days'),
        //     'condition' => $request->input('condition')
        // ]);

        // if($create)
        //     return response()->json(array('success' => true, 'msg' => 'Email Schedule Created'));
        $sched_data = array();

        $invoice_ids = explode(",",$request->input('invoice_ids'));

        foreach($request->input() as $key=>$value){
  
            switch($key){
                case 'days':
                    foreach($value as $k=>$v){
                        $sched_data[$k][$key] = [$v][0];
                    }
                break;

                case 'condition':
                    foreach($value as $k=>$v){
                        $sched_data[$k][$key] = [$v][0];  
                    }
                break;
            }
        }

        foreach($invoice_ids as $id){
            foreach($sched_data as $temp_id=>$data){
                $create = EmailSchedule::create([
                    'template_id'  => $temp_id,
                    'invoice_id'  => $id,
                    'days' => $data['days'][0],
                    'condition' => $data['condition'][0]
                ]);
            }
        }

        return response()->json(array('success' => true, 'msg' => 'Schedules Created'));
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

        $data['schedule'] = EmailSchedule::find($id);
        
        $template = EmailTemplate::find($data['schedule']->template_id);
        $invoice = Invoice::find($data['schedule']->invoice_id);

        $inv = DB::table('inv_settings')->first();

        $customer = Customer::find($invoice->cust_id);

        $newBody = $template->body;

        $variables = array(
            'customer_name' => $customer->display_name,
            'invoice_number' => $inv->inv_name.$invoice->invoice_code,
            'signature' => '',
            'due_date' => $invoice->due_date,
            'invoice_link' => '',
            'reminder_number' => '',
            'invoice_amount' => $invoice->final_total,
            'balance_due' => ''
        );

        foreach($variables as $name=>$value):
            $newBody = str_replace('[['.$name.']]',$value, $newBody);
        endforeach;

        $data['template'] = $newBody;
        return response()->json($data);
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
            'id' => ['required'],
            'days' => ['required'],
            'condition' => ['required']
        ]);
        

        $id = $request->input('id');

        $template = EmailSchedule::find($id);
        $template->days = $request->input('days');
        $template->condition = $request->input('condition');
        $template->save();

        if($template)
            return response()->json(array('success' => true, 'msg' => 'Schedule Updated'));
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

        $delete = EmailSchedule::find($id)->delete();

        if($delete)
            return response()->json(array('success' => true, 'msg' => 'Schedule Deleted'));
    }
}
