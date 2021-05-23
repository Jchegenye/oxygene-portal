<?php

namespace App\Mail\Supplier;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminNotifier extends Mailable
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

        $objStep1 = json_decode($this->data['step1']); 
        $step1 = $objStep1->basicinfo;

        $createdAt = \Carbon\Carbon::parse($this->data->created_at);
        $createdAt->format('Y-m-d-h:i:s');
        
        // Send attached files
        $response = $this->subject("Supplier Application | $step1->full_name_organization | $suplyNo")
        ->markdown('emails.supplier.admin', ['data', $this->data]);
            $location = storage_path("app/public/");
            //1. basic info
            foreach (json_decode($this->data->step1)->cert_of_changeofname as $key => $value) {
                $response->attach($location . $value->path);
            }
            foreach (json_decode($this->data->step1)->cert_of_registration as $key => $value) {
                $response->attach($location . $value->path);
            }
            //2. evaluation
            foreach (json_decode($this->data->step4)->evaluation as $key => $value) {
                $response->attach($location . $value->path);
            }
            //3. litigation file
            foreach (json_decode($this->data->step3)->litigation_file as $key => $value) {
                $response->attach($location . $value->path);
            }
            //4. declaration
            foreach (json_decode($this->data->step6)->signed_sealed as $key => $value) {
                $response->attach($location . $value->path);
            }
            // Attach application attachment
            $response->attachData(base64_decode($this->pdf), $this->data->supplier_number.'-'.'Supplier-Application'.'-'.$createdAt.'.pdf', [
                'mime' => 'application/pdf',
            ]);

        return $response;
    }
}
