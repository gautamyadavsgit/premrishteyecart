<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function __construct()
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        $data['cssArray'] = ['//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css'];
        $data['jsArray'] = ['//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js'];
        return view('admin.users.index', $data);
    }
    public function data(Request $request)
    {

        $data = $request->post();
        $start = $data['start'];
        $limit = $data['length'];
        $searchValue = $data['search']['value'];
        $totalData = User::count();
        $totalFiltered = $totalData;
        if (empty($searchValue)) {
            $users = User::offset($start)->limit($limit)->get();
        } else {
            $users = User::where('name', 'like', "%$searchValue%")->orWhere('email', 'like', "%$searchValue%")->orWhere('mobile', "%$searchValue%")->offset($start)->limit($limit)->get();
            $totalFiltered = User::where('name', 'like', "%$searchValue%")->orWhere('email', 'like', "%$searchValue%")->orWhere('mobile', "%$searchValue%")->count();
        }
        if (!empty($users)) {
            foreach ($users as $user) {
                $nestedData['id'] = $user->id;
                $nestedData['name'] = $user->name;
                $nestedData['email'] = $user->email;
                $nestedData['phone'] = $user->mobile;
                $nestedData['status'] = $user->status;
                $response_data[] = $nestedData;
            }
        }
        $json_data = array(
            $json_data = array(
                "draw" => intval($request->input('draw')),
                "recordsTotal" => $totalData,
                "recordsFiltered" => $totalFiltered,
                "data" => $response_data
            )
        );
        return response()->json($json_data);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['cssArray'] = [];
        $data['jsArray'] = [];
        return view('admin.users.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|string',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|min:10|max:10',
            'status' => 'required|min:1|numeric',
            'password' => 'required|min:6',
            'roll' => 'required|min:1|numeric',
        ]);

        $user = User::create($request->all());
        if ($user)
            return redirect()->back()->with('success', 'User added successfully');
        else
            return redirect()->back()->with('error', 'Failed to add user');
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
