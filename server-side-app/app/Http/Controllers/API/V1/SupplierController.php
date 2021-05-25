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
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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

        //supplier NO.
        $supplierNo = json_decode($request->supplier_number);
        //email
        $userEmail = json_decode($request->company_email_address);

        // logo
        $path = env('APP_NORMAL_URL').'/images/oxygene-logo.png';
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $logo = 'data:image/' . $type . ';base64,' . base64_encode($data);

        // CHECK EXISTANCE
        if (Supplier::where('supplier_number', '=', $supplierNo)->first()) { 
            return response()->json([
                'status' => 'warning', 
                'message'=> "Application No. ".$supplierNo." is already submitted"
            ], 201);
        } else {

            // STEP 1 BASIC INFO
            $basicinfo = json_decode($request->basicinfo);
            //delete files data in step1 array
            $arrBasicInfo = (array)$basicinfo;
            unset($arrBasicInfo['cert_of_changeofname']);
            unset($arrBasicInfo['cert_of_registration']);
            
            //STEP 6
            $step6 = json_decode($request->declaration);
            //delete files data in step1 array
            $step6Data = (array)$step6;
            unset($step6Data['signed_sealed']);
            //formatted date
            $step6Date = \Carbon\Carbon::parse($step6->date)->format('F j, Y');

            // REQUEST STEPs FILES
            $step1by1_files = [];
            $step1by2_files = [];
            $step6_files = [];
            $step4_files = [];
            $step3_files = [];

            // STORE FILES
            $req = $request->all();
            foreach ($req as $key => $value) {

                if (Str::startsWith( $key, "step1by1_file")) {
                    // store files temporary in local & database
                    $fileName = time().'_'.$request[$key]->getClientOriginalName();
                    $filePath = $request->file($key)->storeAs($basicinfo->full_name_organization.'/'.$step6Date.'/Certificate of Change of Name', $fileName, 'public');
                    array_push($step1by1_files, [
                        "name" => $fileName,
                        "path" => $filePath
                    ]);
                    // upload to dropbox
                    Storage::disk('dropbox')->put('Supplier Applications/'.$filePath, file_get_contents($request[$key]));

                }
                if (Str::startsWith( $key, "step1by2_file")) {
                    $fileName = time().'_'.$request[$key]->getClientOriginalName();
                    $filePath = $request->file($key)->storeAs($basicinfo->full_name_organization.'/'.$step6Date.'/Certificate of Registration', $fileName, 'dropbox');
                    array_push($step1by2_files, [
                        "name" => $fileName,
                        "path" => $filePath
                    ]);
                    // upload to dropbox
                    Storage::disk('dropbox')->put('Supplier Applications/'.$filePath, file_get_contents($request[$key]));
                }
                if(Str::startsWith( $key, "step3_file")) {
                    $fileName = time().'_'.$request[$key]->getClientOriginalName();
                    $filePath = $request->file($key)->storeAs($basicinfo->full_name_organization.'/'.$step6Date.'/Litigation', $fileName, 'dropbox');
                    array_push($step3_files, [
                        "name" => $fileName,
                        "path" => $filePath
                    ]);
                }
                if (Str::startsWith( $key, "step4_file")) {
                    $fileName = time().'_'.$request[$key]->getClientOriginalName();
                    $filePath = $request->file($key)->storeAs($basicinfo->full_name_organization.'/'.$step6Date.'/Evaluation', $fileName, 'dropbox');
                    array_push($step4_files, [
                        "name" => $fileName,
                        "path" => $filePath
                    ]);
                    // upload to dropbox
                    Storage::disk('dropbox')->put('Supplier Applications/'.$filePath, file_get_contents($request[$key]));
                }
                if (Str::startsWith( $key, "step6_file")) {
                    $fileName = time().'_'.$request[$key]->getClientOriginalName();
                    $filePath = $request->file($key)->storeAs($basicinfo->full_name_organization.'/'.$step6Date.'/Declaration', $fileName, 'dropbox');
                    array_push($step6_files, [
                        "name" => $fileName,
                        "path" => $filePath
                    ]);
                    // upload to dropbox
                    Storage::disk('dropbox')->put('Supplier Applications/'.$filePath, file_get_contents($request[$key]));
                }
            }

            // STORE
            $data = Supplier::updateOrCreate(
                ['supplier_number' => $supplierNo],
                [
                    'company_email_address' => str_replace('"', '', $userEmail),
                    'user_id' => 0,
                    'supplier_number' => str_replace('"', '', $supplierNo),

                    'step1' => json_encode([
                        "cert_of_changeofname" => $step1by1_files,
                        "cert_of_registration" => $step1by2_files,
                        'basicinfo' => $arrBasicInfo
                    ]),
                    'step2' =>json_decode($request->step2, true),
                    'step3' => json_encode([
                        "litigation_file" => $step3_files,
                        'litigation' => $request->litigation
                    ]),
                    'step4' => json_encode([
                        "evaluation" => $step4_files
                    ]),
                    'step6' => json_encode([
                        "signed_sealed" => $step6_files,
                        'declaration' => $step6Data
                    ]),
                ]
            );

            // // USER DETAILS
            $fullNames = $basicinfo->full_name_organization;
            $parts = explode(' ', $fullNames);
            $name_first = array_shift($parts);
            $name_last = array_pop($parts);
            $name_middle = trim(implode(' ', $parts));

            $date = \Carbon\Carbon::now();
            $stampDateTime = clone($date);

            $nickname = Str::lower($name_first);

            // REGISTER USER
            DB::table('users')
                ->updateOrInsert(
                    ['email' => $userEmail],
                    [
                        'first_name' => $name_first,
                        'last_name' => $name_last.' '.$name_middle,
                        'email' => $userEmail,
                        'password' => Hash::make($supplierNo),
                        'nickname' => $nickname,
                        'role_id' => 5,
                        'agreement' => 0,
                        'created_at' => $stampDateTime,
                        'updated_at' => $stampDateTime
                    ]
                );
        
            // // PDF
            $supplierPdf = PDF::loadView('pdfs.supplier.application', compact('data','logo'))
                ->setOptions(['defaultFont' => 'Montserrat']);

            // // EMAILS
            $supplierEmail = \Mail::to($data->company_email_address)
                ->send(new ApplicationNotifier($data,$supplierPdf->output()));
            $adminEmail = \Mail::to(env('MAIL_FINANCE_ADDRESS'))
                ->cc(env('MAIL_PROCUREMENT_ADDRESS'))
                ->send(new AdminNotifier($data, $supplierPdf->output()));

            // DELETE LOCAL FILES
            Storage::disk('public')->deleteDirectory($fullNames);

            // ERROR RESPONSE
            if(!$data AND !$supplierEmail AND !$adminEmail){
                return response()->json([
                    'status' => 'error',
                    'message'=> "Sorry, something went wrong!"
                ], 500);
            }
            
            // SUCCESS RESPONSE
            return response()->json([
                'status' => 'success',
                'message'=> "Application No. ".$supplierNo." has been submitted."
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
