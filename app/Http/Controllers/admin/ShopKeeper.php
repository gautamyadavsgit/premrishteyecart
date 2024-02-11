<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShopPaymentLink;
use App\Enums\PaymentMerchants;
use Illuminate\Validation\Rules\File;
class ShopKeeper extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['cssArray'] = ['//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css'];
        $data['jsArray'] = ['//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js'];


        return view('admin.shop.index', $data);
    }
    public function shop_list(Request $request)
    {
        dd($request);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $data['cssArray'] = [];
        $data['jsArray'] = ['https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js'];

        $data['roles'] = [];
        $data['user'] = [];
        $data['paymentOptions'] = PaymentMerchants::getEnumValues('shop_payment_links', 'key');


        return view('admin.shop.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'mobile' => 'required|numeric',
            'whatsapp' => 'nullable|string|max:255',
            'about' => 'required',
            'message' => 'required',
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
         ]);
        if ($request->hasFile('back-cover')) {
            $file = $request->file('back-cover');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = 'back-cover/' . $fileName;

            // Move the uploaded file to the desired storage location
            $file->storeAs('public', $filePath);

            // Save the file name and path to the database or use it as needed
            // ...
        }

        $userData = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ];
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
