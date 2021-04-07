<?php

namespace App\Mail\Supplier;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApplicationNotifier extends Mailable
{
    use Queueable, SerializesModels;

    public $data = [];
    public $pdf;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, string $pdf)
    {
        $this->data = $data;
        $this->pdf = base64_encode($pdf);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $company = config('app.name');
        $suplyNo = $this->data->supplier_number;
        $createdAt = \Carbon\Carbon::parse($this->data->created_at);
        $createdAt->format('Y-m-d-h:i:s');

        return $this->subject("Supplier Application No. $suplyNo | $company")
            ->markdown('emails.supplier.application', ['data', $this->data])
            ->attachData(base64_decode($this->pdf), $this->data->supplier_number.'-'.'Supplier-Application'.'-'.$createdAt.'.pdf', [
                'mime' => 'application/pdf',
            ]);
    }
}
