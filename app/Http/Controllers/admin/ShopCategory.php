<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategory;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Schema;
use App\Models\ShopPaymentLink;

class ShopCategory extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data["cssArray"] = ['//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css',];
        $data["jsArray"] = ['//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js'];
        dd($data['paymentOptions']);
        return view("admin.category.index", $data);
    }


    public function category_list(Request $request)
    {
        $response_data = [];
        $input = $request->post();
        $start = $input['start'];
        $limit = $input['length'];
        $total = Category::count();
        $search = $input['search']['value'];
        $totalFiltered = $total;
        if ($search != '') {
            $rows = Category::where('category', 'like', '%' . $search . '%')->orderBy('id', 'desc')->offset($start)->limit($limit)->get();
            $totalFiltered = Category::where('category', 'like', '%' . $search . '%')->offset($start)->limit($limit)->count();
        } else {
            $rows = Category::offset($start)->orderBy('id', 'desc')->limit($limit)->get();
        }
        foreach ($rows->toArray() as $row) {
            $data['id'] = $row['id'];
            $data['name'] = $row['category'];
            $data['button'] =
                '<form id="delete_category" action="' . route('category.destroy', ['category' => $row['id']]) . '" method="POST" style="display: inline;">' .
                '<input type="hidden" name="_token" value="' . csrf_token() . '">' .
                '<input type="hidden" name="_method" value="DELETE">' .
                '<button type="submit" class="btn btn-danger" onclick="return confirm(\'Are you sure you want to delete this qr?\')">Delete</button> &nbsp; &nbsp;' .
                '</form>' . '<button class="btn btn-info" onclick="editCat(' . $row['id'] . ',`' . $row['category'] . '`)">Edit</button>';
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category' => 'required|max:20'
        ]);
        DB::beginTransaction();

        try {
            Category::create($validatedData);
            DB::commit();
            return response()->json(["message" => "Category Created Successfully"], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(["message" => $e]);
        }
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

        $category = Category::findOrFail($id);
        $validatedData = $request->validate([
            'category' => 'required|max:255',
        ]);
        DB::beginTransaction();
        try {
            $category->update($validatedData);
            DB::commit();
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollback();
            return redirect()->back()->with(["error" => "Error en la base de datos"], 422);
        }
        return redirect()->back()->with(['success' => 'Category Updated']);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Category::findOrfail($id);
        Category::destroy($id);
        return redirect()->route('category.index')->with(['success' => 'Deleted successfully']);
    }
}
