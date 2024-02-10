<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShopPaymentLink;
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
        $data['jsArray'] = [];

        $data['roles'] = [];
        $data['user'] = [];
        $data['paymentOptions'] = getEnumValues('shop_payment_links', 'value');
        
        dd($data['paymentOptions']);

        return view('admin.shop.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
