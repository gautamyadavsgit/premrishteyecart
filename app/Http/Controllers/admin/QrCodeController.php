<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\QrCode as QrModel;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use App\Jobs\GenerateQrCodes;

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
        $totalFiltered = $total;
        if ($search != '') {
            $rows = QrModel::where('encoded_data', 'like', '%' . $search . '%')->offset($start)->limit($limit)->get();
            $totalFiltered = QrModel::where('encoded_data', 'like', '%' . $search . '%')->offset($start)->limit($limit)->count();
        } else {
            $rows = QrModel::offset($start)->limit($limit)->get();
        }
        foreach ($rows->toArray() as $row) {
            $data['id'] = $row['id'];

            $data['name'] = $row['encoded_data'];
            $data['path'] = '<img src="' . Storage::disk('public')->url($row['path']) . '" />';
            $data['user'] = $row['user_id'];
            $data['button'] =
                '<form action="' . route('qr-code.destroy', ['qr_code' => $row['id']]) . '" method="POST" style="display: inline;">' .
                '<input type="hidden" name="_token" value="' . csrf_token() . '">' .
                '<input type="hidden" name="_method" value="DELETE">' .
                '<button type="submit" class="btn btn-danger" onclick="return confirm(\'Are you sure you want to delete this qr?\')">Delete</button>' .
                '</form>';
            $response_data[] = $data;
        }
        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => $total,
            "recordsFiltered" => $totalFiltered,
            "data" => $response_data
        );

        return response($json_data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

        GenerateQrCodes::dispatch()->times();
    }

    /**
     * Store a newly created resource in storage.
     */

    public static function generate_qr($qua)
    {
    }
    public function store(Request $request)
    {
        $quantity = $request->input('quantity');
        // Artisan::call('app:generate-qr-codes', ['quantity' => $quantity]);
        for ($i = 1; $i <= $quantity; $i++) {
            GenerateQrCodes::dispatch();
        }
        return response()->json(['message' => 'Jobs dispatched successfully']);
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
        $qr = QrModel::findOrfail($id);
        if ($qr) {
            if (Storage::exists('public/' . $qr->path)) {
                Storage::delete('public/' . $qr->path);
            }
            $qr->delete();
            return redirect()->back()->with('success', 'qr deleted successfully');
        }
    }
}
