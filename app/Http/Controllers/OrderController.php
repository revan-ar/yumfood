<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->input('vendor') != null && $request->input('dishes') == null){
            $getOrders = Order::where('vendor_id', $request->input('vendor'))->get();
            if($getOrders){
                $response = [
                    'code' => 200,
                    'message' => 'order vendor ini ditemukan !',
                    'data' => $getOrders 
                ];
            }else{
                $response = [
                    'code' => 200,
                    'message' => 'order vendor ini masih kosong',
                    'data' => [] 
                ];                                
            }
        }else if($request->input('vendor') != null && $request->input('dishes') == 1){
            $getDishesOrder = [
                'vendor_id' => $request->input('vendor'),
                'dishes' => 1
            ];

            $getOrders = Order::where($getDishesOrder)->get();
            if($getOrders){
                $response = [
                    'code' => 200,
                    'message' => 'hidangan yang telah siap sudah ada !',
                    'data' => $getOrders 
                ];
            }else{
                $response = [
                    'code' => 200,
                    'message' => 'semua order masih dalam proses',
                    'data' => $getOrders 
                ];                
            }
        }else{
            $response = [
                'code' => 400,
                'message' => 'data order tidak ditemukan',
                'data' => [] 
            ];
        }

        return response()->json($response);
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
        $inputOrder = Order::insert($request->input());
        if($inputOrder){
            $response = [
                'code' => 200,
                'message' => 'order kamu sudah dikirim, mohon menunggu hingga order selesai !',
            ];
        }else{
            $response = [
                'code' => 200,
                'message' => 'order kamu gagal dikirim, mohon menunggu tunggu beberapa saat untuk mencoba order lagi !',
            ];            
        }

        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
}
