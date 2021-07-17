<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendInvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $invoice;
    protected $pdf;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($invoice, $pdf)
    {
        $this->invoice = $invoice;
        $this->pdf = $pdf;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data['invoice'] = $this->invoice;
        // $path = public_path(). '/invoice/inv-'.$this->invoice->invoice_id.'.pdf';
         return $this->view('emails.send-invoice')
            ->with($data)
            ->attachData($this->pdf->output(), 
                         'invsda.pdf',['mime' => 'application/pdf']);
    }
}
