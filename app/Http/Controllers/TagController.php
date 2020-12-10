<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $reqData = $request->input();
        if(array_key_exists("name", $reqData)){
            $acceptName = gettype($request->input('name')) == 'string' ? true : false;

            if($acceptName){
                $save = Tag::insert($request->all());
                if($save){
                    $reponse = [
                        'code' => 201,
                        'status' => true,
                        'data' => ['message' => 'berhasil menambah tag']
                    ];
                }else{
                    $reponse = [
                        'code' => 200,
                        'status' => false,
                        'data' => ['message' => 'gagal menambah tag']
                    ];               
                }
            }else{            
                $reponse = [
                    'code' => 400,
                    'status' => false,
                    'data' => ['message' => 'tag tidak boleh berupa angka']
                ];               
            }
        }else{
            $reponse = [
                'code' => 400,
                'status' => false,
                'data' => ['message' => 'parameter salah']
            ];               
        }

        return response()->json($reponse);

    }

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
}
