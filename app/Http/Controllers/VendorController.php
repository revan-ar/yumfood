<?php

namespace App\Http\Controllers;

use App\Http\Resources\VendorResource;
use App\Http\Resources\TagResource;
use App\Vendor;
use App\Tag;
use App\Taggables;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        if($request->input() != null){
            $isArray = gettype($request->input("tags")) == 'array' ? true : false;
            if($isArray){
                $data = [];
                foreach($request->input('tags') as $keyTags){
                    $getTags = Tag::where('name', $keyTags)->first();
                    if($getTags == null){
                        $response = [
                            'code' => 400,
                            'message' => 'pencarian gagal, pastikan tag yang anda cari sudah benar !',
                            'data' => $data
                        ];

                        // Return Error
                        return response()->json($response);
                    }else{

                        $getTaggables = Taggables::join('vendors', 'id', '=', 'taggable_id')->where('tag_id', $getTags->id)->get();
                        foreach($getTaggables as $vendorValue){
                            $data[$keyTags][] = $vendorValue->name;
                        }

                    }

                }

                $response = [
                    'code' => 200,
                    'message' => 'vendor berhasil ditemukan !',
                    'data' => $data
                ];

            }else{
                $response = [
                    'code' => 400,
                    'message' => 'vendor gagal ditemukan',
                    'data' => $data
                ];
            }

            return response()->json($response);

        }else{
            
            return VendorResource::collection(Vendor::paginate());
        }
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
                $save = Vendor::insert($request->all());
                if($save){
                    $reponse = [
                        'code' => 201,
                        'status' => true,
                        'data' => ['message' => 'berhasil menambah vendor']
                    ];
                }else{
                    $reponse = [
                        'code' => 200,
                        'status' => false,
                        'data' => ['message' => 'gagal menambah vendor']
                    ];               
                }
            }else{            
                $reponse = [
                    'code' => 400,
                    'status' => false,
                    'data' => ['message' => 'vendor tidak boleh berupa angka']
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
        $getVendor = Vendor::find($id);
        ($getVendor != null) ? $reponse = ['data' => [$getVendor, 'tags' => $getVendor['tags']]] : $reponse = ['data' => null];
        return response()->json($reponse);
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
        $update = Vendor::where('id', $id)->update($request->all());
        ($update) ? $reponse = ['code' => 200, 'status' => false, 'data' => ['message' => 'update data vendor berhasil']] : $reponse = ['code' => 400, 'status' => false, 'data' => ['message' => 'update data vendor gagal']];                
        return response()->json($reponse);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Vendor::where('id', $id)->delete();
        ($update) ? $reponse = ['code' => 200, 'status' => false, 'data' => ['message' => 'data vendor berhasil dihapus']] : $reponse = ['code' => 400, 'status' => false, 'data' => ['message' => 'data vendor gagal dihapus']];
        return response()->json($reponse);
    }
}
