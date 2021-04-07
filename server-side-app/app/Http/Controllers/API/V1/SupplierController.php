<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\Supplier\ApplicationNotifier;
use App\Mail\Supplier\AdminNotifier;
Use Exception;
use App\Models\Supplier;
use Helper;
use PDF;
use DB;
use Auth;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $path = env('APP_NORMAL_URL').'/images/oxygene-logo.png';
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $logo = 'data:image/' . $type . ';base64,' . base64_encode($data);

        $data = Supplier::get()->first();
        return view('pdfs.supplier.application', compact('data', 'logo'));
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
        // logo
        $path = env('APP_NORMAL_URL').'/images/oxygene-logo.png';
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $logo = 'data:image/' . $type . ';base64,' . base64_encode($data);

        // CHECK EXISTANCE
        if (Supplier::where('supplier_number', '=', $request->supplier_number)->exists()) {
            return response()->json([
                'status' => 'warning', 
                'message'=> "Application No. ".$request->supplier_number." is already submitted"
            ], 201);
        }

        // STORE
        $data = Supplier::updateOrCreate(
            ['supplier_number' => $request->supplier_number],
            [
                'company_email_address' => $request->company_email_address,
                'user_id' => 0,
                'supplier_number' => $request->supplier_number,
                'step1' => $request->step1,
                'step2' => $request->step2,
                'step3' => $request->step3,
                'step4' => $request->step4,
                'step6' => $request->step6,
            ]
        );
        
        // PDF
        $supplierPdf = PDF::loadView('pdfs.supplier.application', compact('data','logo'))
            ->setOptions(['defaultFont' => 'Montserrat']);

        // EMAILS
        $supplierEmail = \Mail::to($data->company_email_address)
            ->send(new ApplicationNotifier($data,$supplierPdf->output()));
        $adminEmail = \Mail::to(env('MAIL_FINANCE_ADDRESS'))
            ->cc(env('MAIL_PROCUREMENT_ADDRESS'))
            ->send(new AdminNotifier($data,$supplierPdf->output()));

        if(!$data AND !$supplierEmail AND !$adminEmail){
            return response()->json([
                'status' => 'error',
                'message'=> "Sorry, something went wrong!"
            ], 500);
        }

        return response()->json([
            'status' => 'success',
            'message'=> "Application No. ".$request->supplier_number." has been submitted."
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function supplierNumber()
    {
        try{
            
            $type = env('SUPPLIER_NUMBER_FORMAT','SPLY-OMCL-');
            $data = DB::table('suppliers')
                    ->where('supplier_number', 'like', $type.'%')
                    ->count();

            $number = Helper::numberGenerator($type, $data);
            
            return response()->json($number);
            
        }catch(Exception $e){
            return response()->json(['status' => 'error', 'message'=> $e->getMessage()]);
        }
        
    }
}
