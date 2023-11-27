<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\QrCode as QrModel;
use Illuminate\Support\Facades\Storage;

class QrCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data["cssArray"] = ['//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css'];
        $data["jsArray"] = ['//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js'];
        return view("admin.qrcode.index", $data);
    }

    public function qr_list(Request $request)
    {
        $input = $request->post();
        $start = $input['start'];
        $limit = $input['length'];
        $total = QrModel::count();
        $search = $input['search']['value'];
        if($search != ''){
            $rows = QrModel::where('encoded_data','like','%'.$search.'%')->offset($start)->limit($limit)->get();
            $totalFiltered = QrModel::where('encoded_data','like','%'.$search.'%')->offset($start)->limit($limit)->count();
        }else{
            $rows = QrModel::offset($start)->limit($limit)->get();
        }
        foreach($rows->toArray() as $row){
            $data['name'] = 
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    public static function generate_qr()
    {
        for ($i = 0; $i < 10; $i++) {
            $timestamp = Carbon::now()->timestamp;
            $dataToEncode = url("scanqr") . '/' . $timestamp;

            // Generate QR code image in memory
            $qrCodeImage = QrCode::format('png')->size(500)->errorCorrection('H')->generate($dataToEncode);

            // Move the generated QR code image to a storage directory
            $fileName = $timestamp . '_' . uniqid() . '.png'; // Unique file name
            $storagePath = 'uploads/QRcode/' . $fileName;

            Storage::put($storagePath, $qrCodeImage);

            // Optionally, you can also save relevant information to your database
            $res = QrModel::create([
                'encoded_data' => $dataToEncode,
                'path' => $storagePath,
            ]);
            sleep(1);
        }
    }
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
