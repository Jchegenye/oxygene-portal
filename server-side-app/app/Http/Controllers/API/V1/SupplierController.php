<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\Supplier\ApplicationNotifier;
use App\Mail\Supplier\AdminNotifier;
use Illuminate\Support\Str;
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
        if (Supplier::where('supplier_number', '=', $request->supplier_number)->first()) {
            return response()->json([
                'status' => 'warning', 
                'message'=> "Application No. ".$request->supplier_number." is already submitted"
            ], 201);
        } else {

            // REQUEST STEPs FILES
            $step4_files = [];
            $step3_files = [];

            $req = $request->all();
            foreach ($req as $key => $value) {
                if (Str::startsWith( $key, "step4_file")) {
                    $fileName = time().'_'.$request[$key]->getClientOriginalName();
                    $filePath = $request->file($key)->storeAs('procurement', $fileName, 'public');
                    array_push($step4_files, [
                        "name" => $fileName,
                        "path" => $filePath
                    ]);
                }
                if(Str::startsWith( $key, "step3_file")) {
                    $fileName = time().'_'.$request[$key]->getClientOriginalName();
                    $filePath = $request->file($key)->storeAs('litigation', $fileName, 'public');
                    array_push($step3_files, [
                        "name" => $fileName,
                        "path" => $filePath
                    ]);
                }
            }

            // STORE
            $data = Supplier::updateOrCreate(
                ['supplier_number' => $request->supplier_number],
                [
                    'company_email_address' => str_replace('"', '', $request->company_email_address),
                    'user_id' => 0,
                    'supplier_number' => str_replace('"', '', $request->supplier_number),
                    'step1' =>json_decode($request->step1, true),
                    'step2' =>json_decode($request->step2, true),
                    //'step3' =>json_decode($request->step3, true),
                    'step3' => json_encode([
                        "litigation_file" => $step3_files,
                        'litigation' => $request->litigation
                    ]),
                    'step4' => json_encode([
                        "evaluation" => $step4_files
                    ]),
                    'step6' => json_decode($request->step6, true)
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
                ->send(new AdminNotifier($data, $supplierPdf->output()));

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
