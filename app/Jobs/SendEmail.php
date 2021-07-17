<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\EmailSchedule;
use App\EmailTemplate;
use App\Invoice;
use App\Customer;

use DB;

use App\Mail\InvoiceMail;
use Illuminate\Support\Facades\Mail;

use Carbon\Carbon;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $schedules = EmailSchedule::all();
        
        $inv = DB::table('inv_settings')->first();
        
        foreach($schedules as $schedule):

            if($schedule->status == 'pending'){
                $template = EmailTemplate::find($schedule->template_id);
                $invoice = Invoice::find($schedule->invoice_id);
                $newBody = $template->body;
                $subject = $template->subject;

                $sendEmail = false;
                switch($schedule->condition):
                    case 'before':
                        
                        $due_date = Carbon::parse($invoice->due_date);
                        $before_due_date = $due_date->subDays($schedule->days)->format('Y-m-d');
                        $today = Carbon::now()->format('Y-m-d');

                        if($before_due_date == $today){
                            $sendEmail = true;
                        }
                        
                    break;
                    
                    case 'after':

                        $due_date = Carbon::parse($invoice->due_date);
                        $before_due_date = $due_date->addDays($schedule->days)->format('Y-m-d');
                        $today = Carbon::now()->format('Y-m-d');

                        if($before_due_date == $today){
                            $sendEmail = true;
                        }
                    break;
                endswitch;
                
                
                if($sendEmail){
                    $customer = Customer::find($invoice->cust_id);

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
                        $subject = str_replace('[['.$name.']]',$value, $subject);
                    endforeach;
                    
                    if($customer->email != NULL){
                        Mail::to($customer->email)->send(new InvoiceMail($subject, $newBody));
                        
                        $me = EmailSchedule::find($schedule->id);
                        $me->status = 'delivered';
                        $me->save();
                        
                    }else{
                        echo 'Customer has no email address.';
                    }
                }
            }
        endforeach;
    }
}
