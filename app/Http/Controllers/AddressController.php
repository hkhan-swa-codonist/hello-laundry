<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Address;
use Illuminate\Support\Facades\DB;
class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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
        $input = $request->all();

        $validator =  Validator::make($input,[
            'customer_id' => 'required',
            'address' => 'required',
            'unique_id' => 'required',
            'type' => 'required',
            'manual_address' => 'required'
            
        ]);

        if($validator->fails()){
            return $this->sendError($validator->errors());
        }
        $input['status'] = 1;

        if($input['type'] == 1 || $input['type'] == 2 || $input['type'] == 3){
            $old_data = Address::where('type',$input['type'])->first();
            //print_r($old_data);exit;
            if(is_object($old_data)){
                //Address::where('id',$old_data->id)->delete();
                Address::where('id',$old_data->id)->update([ 'customer_id' => $input['customer_id'],'manual_address' => $input['manual_address'],  'address' => $input['address'],'unique_id' => $input['unique_id'],'type' => $input['type']]);
                $id = Address::where('type',$input['type'])->value('id');
                //print_r($data);exit;
            }else{
                $id = Address::create($input)->id;
            }
            //print_r($id);exit;
            if($id) {
            return response()->json([
                "message" => 'Registered Successfully',
                "status" => 1
            ]);
            } else {
            return response()->json([
                "message" => 'Sorry, something went wrong !',
                "status" => 0
            ]);
            }
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
        $input['id'] = $id;

        $validator =  Validator::make($input,[
            'id' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError($validator->errors());
        }

        $address = Address::where('id',$input['id'])->first();

        if ($address) {
            return response()->json([
                "result" => $address,
                "message" => 'Success',
                "status" => 1
            ]);
        } else {
            return response()->json([
                "message" => 'Sorry, something went wrong !',
                "status" => 0
            ]);
        }
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
        $input = $request->all();

        $validator =  Validator::make($input,[
            'customer_id' => 'required',
            'address' => 'required',
            'unique_id' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError($validator->errors());
        }
        $input['status'] = 1;

        if (Address::where('id',$id)->update($input)) {
            return response()->json([
                "message" => 'Updated Successfully',
                "status" => 1
            ]);
        } else {
            return response()->json([
                "message" => 'Sorry, something went wrong !',
                "status" => 0
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $input = $request->all();

        $validator =  Validator::make($input,[
            'customer_id' => 'required',
            'address_id' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError($validator->errors());
        }
        $res = Address::where('id',$input['address_id'])->delete();
        if ($res) {
            $addresses = Address::where('customer_id',$input['customer_id'])->orderBy('created_at', 'desc')->get();
            return response()->json([
                "result" => $addresses,
                "message" => 'Deleted Successfully',
                "status" => 1
            ]);
        } else {
            return response()->json([
                "message" => 'Sorry, something went wrong !',
                "status" => 0
            ]);
        }
    }

    public function all_addresses(Request $request){

        $input = $request->all();

        $validator =  Validator::make($input,[
            'customer_id' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError($validator->errors());
        }

        $addresses = Address::where('customer_id',$input['customer_id'])->orderBy('created_at', 'desc')->get();

        if ($addresses) {
            return response()->json([
                "result" => $addresses,
                "message" => 'Success',
                "status" => 1
            ]);
        } else {
            return response()->json([
                "message" => 'Sorry, something went wrong !',
                "status" => 0
            ]);
        }
    }
    
    public function check_post_code(Request $request){

        $input = $request->all();

        $validator =  Validator::make($input,[
            'post_code' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError($validator->errors());
        }
        
        $code = substr($input['post_code'],0,3);
        $code = strtoupper($code);

        $post_code = DB::table('post_codes')->where('post_code', 'like', $code . '%')->first();

        if (is_object($post_code)) {
            return response()->json([
                "result" => $post_code,
                "message" => 'Success',
                "status" => 1
            ]);
        } else {
            return response()->json([
                "message" => 'Sorry, Service not available at this location',
                "status" => 0
            ]);
        }
    }

    public function sendError($message) {
        $message = $message->all();
        $response['error'] = "validation_error";
        $response['message'] = implode('',$message);
        $response['status'] = "0";
        return response()->json($response, 200);
    }
}
