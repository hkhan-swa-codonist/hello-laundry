<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Order;
use App\Product;
use App\CustomerCard;
use App\Service;
use App\Customer;
use App\AppSetting;
use App\CustomerWalletHistory;
use App\OrderItem;
use App\OrderService;
use App\PaymentResponse;
use App\Label;
use Validator;
use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Database;
use App\FcmNotificationMessage;
use Cartalyst\Stripe\Stripe;
class OrderController extends Controller
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
        $input = $request->all();
        $validator = Validator::make($input, [
            'customer_id' => 'required',
            'address_id' => 'required',
            'delivery_date' => 'required',
            'delivery_time' => 'required',
            'pickup_date' => 'required',
            'pickup_time' => 'required',
            'payment_mode' => 'required',
            'payment_response' => 'required',
        ]);

        if($validator->fails()) {
            return $this->sendError($validator->errors());
        }
        
        /*if($input['payment_mode'] == 3){
            $wallet = Customer::where('id',$input['customer_id'])->value('wallet');
            if($input['total'] > $wallet){
                return response()->json([
                    "message" => 'Sorry, your wallet balance is low !',
                    "status" => 0
                ]);
            }else{
                $new_wallet = $wallet - $input['total'];
                Customer::where('id',$input['customer_id'])->update([ 'wallet' => $new_wallet ]);
                CustomerWalletHistory::create([ 'customer_id' => $input['customer_id'], 'type' => 2, 'message' => $input['total'].' has been debited from your account','message_ar' => $input['total'].'تم خصمه من حسابك', 'amount' => $input['total'] ]);
            }
        }*/
        $payment_response = $input['payment_response'];
        unset($input['payment_response']);
        $data = json_decode($input['data'], true);
        
        //$items = json_decode($input['items'], true);
		//$item_names = $items;
		/*foreach($item_names as $key => $value){
			$item_names[$key]['product_name'] = Product::where('id',$value['product_id'])->value('product_name');
			$item_names[$key]['product_name_ar'] = Product::where('id',$value['product_id'])->value('product_name_ar');
			$item_names[$key]['service_name'] = Service::where('id',$value['service_id'])->value('service_name');
			$item_names[$key]['service_name_ar'] = Service::where('id',$value['service_id'])->value('service_name_ar');
		}
		$input['items'] = json_encode($item_names, JSON_UNESCAPED_SLASHES);
        $input['items'] = preg_replace('/\\\"/',"\"", $input['items']);*/
        
        $input['delivery_date'] = date('Y-m-d', strtotime($input['delivery_date']));
        $input['pickup_date'] = date('Y-m-d', strtotime($input['pickup_date']));
        $order = Order::create($input);
        $order_id = str_pad($order->id, 5, "0", STR_PAD_LEFT);
        Order::where('id',$order->id)->update([ 'order_id'=>$order_id]);
        if (is_object($order)) {
            foreach ($data as $key => $value) {
                if($value){
                    $value['order_id'] = $order->id;
                    unset($value['service_name']);
                    $value['category_id'] = implode(",",$value['category']);
                    OrderService::create($value);    
                }
                
            }
            /*foreach ($items as $key => $value) {
                $value['order_id'] = $order->id;
                OrderItem::create($value);
            }*/
            if($input['payment_mode'] != 1){
                PaymentResponse::where('payment_response',$payment_response)->update(['order_id' => $order->id]);
            }
            
            return response()->json([
                "message" => 'Order Placed Successfully',
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

    public function getOrders(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'customer_id' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }
        if($input['lang'] == 'en'){
            $orders = DB::table('orders')
            ->leftjoin('addresses', 'addresses.id', '=', 'orders.address_id')
            ->leftjoin('labels', 'labels.id', '=', 'orders.status')
            ->leftjoin('payment_methods', 'orders.payment_mode', '=', 'payment_methods.id')
            ->select('orders.id','orders.order_id','payment_methods.payment_mode','addresses.address','orders.pickup_date','orders.pickup_time','orders.delivery_date','orders.delivery_time','orders.status','orders.other_requests','orders.collection_instructions','orders.delivery_instructions','labels.label_name','labels.image','orders.created_at','orders.updated_at')
            ->where('orders.customer_id',$input['customer_id'])
            ->orderBy('orders.created_at', 'desc')
            ->get();
            //print_r($orders);exit;
        }else{
            $orders = DB::table('orders')
            ->leftjoin('addresses', 'addresses.id', '=', 'orders.address_id')
            ->leftjoin('labels', 'labels.id', '=', 'orders.status')
            ->leftjoin('payment_methods', 'orders.payment_mode', '=', 'payment_methods.id')
            ->select('orders.id','orders.order_id','payment_methods.payment_mode_ar as payment_mode','addresses.address','orders.pickup_date','orders.pickup_time','orders.delivery_date','orders.delivery_time','orders.other_requests','orders.collection_instructions','orders.delivery_instructions','orders.status','labels.label_name_ar as label_name','labels.image','orders.created_at','orders.updated_at')
            ->where('orders.customer_id',$input['customer_id'])
            ->orderBy('orders.created_at', 'desc')
            ->get();
        }
        
        foreach($orders as $key => $value){
            if($input['lang'] == 'en'){
                $order_services = DB::table('order_services')
            ->leftJoin('services', 'services.id', '=', 'order_services.service_id')
            ->select('services.service_name','order_services.category_id')
            ->where('order_services.order_id',$value->id)
            ->orderBy('order_services.created_at', 'asc')
            ->get();
            
            foreach($order_services as $key1 => $value){
                $category_name = [];
                $category_id = explode(",",$value->category_id);
                foreach($category_id as $key2 => $cid){
                    $category_name[] = DB::table('categories')->where('id',$cid)->value('category_name');
                }
                $order_services[$key1]->category_name = implode(',',$category_name);
            }
            $orders[$key]->order_services = $order_services;
            }else{
                $order_services = DB::table('order_services')
            ->leftJoin('services', 'services.id', '=', 'order_services.service_id')
            ->select('services.service_name_ar','order_services.category_id')
            ->where('order_services.order_id',$value->id)
            ->orderBy('order_services.created_at', 'asc')
            ->get();
            foreach($order_services as $key => $value){
                $category_name = [];
                $category_id = explode(",",$value->category_id);
                foreach($category_id as $key1 => $cid){
                    $category_name[] = DB::table('categories')->where('id',$cid)->value('category_name');
                }
                $order_services[$key]->category_name = implode(',',$category_name);
            }
            $orders[$key]->order_services = $order_services;
            }
            
        }
        if ($orders) {
            return response()->json([
                "result" => $orders,
                "count" => count($orders),
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

    public function sendError($message) {
        $message = $message->all();
        $response['error'] = "validation_error";
        $response['message'] = implode('',$message);
        $response['status'] = "0";
        return response()->json($response, 200);
    }

    public function order_status_change(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
            'order_id' => 'required',
            'status' => 'required'
        ]);

        if($validator->fails()) {
            return $this->sendError($validator->errors());
        }

        $order = Order::where('id',$input['order_id'])->first();
        if(is_object($order)){
            $old_label = Label::where('id',$input['status'])->first();
            Order::where('id',$input['order_id'])->update([ 'status' => $old_label->id ]);
            $serviceAccount = ServiceAccount::fromJsonFile(config_path().'/'.env('FIREBASE_FILE'));
            $firebase = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->withDatabaseUri(env('FIREBASE_DB'))
            ->create();
            $database = $firebase->getDatabase();
            $database->getReference('delivery_partners/'.$order->delivered_by.'/orders/'.$order->id.'/status')
                ->set($old_label->id);
            $database->getReference('delivery_partners/'.$order->delivered_by.'/orders/'.$order->id.'/status_name')
                ->set($old_label->label_name);
            if($input['status'] != 7){
                $new_label = Label::where('id',$input['status']+1)->first();
                $database->getReference('delivery_partners/'.$order->delivered_by.'/orders/'.$order->id.'/new_status')
                ->set($new_label->id);
                $database->getReference('delivery_partners/'.$order->delivered_by.'/orders/'.$order->id.'/new_status_name')
                ->set($new_label->label_for_delivery_boy);
            }
            
            //fcm msg
            $order_status = Order::where('id',$input['order_id'])->value('status');
            $message = DB::table('fcm_notification_messages')->where('id',$order_status)->first();
            $customer_token = Customer::where('id',$order->customer_id)->value('fcm_token');
            $this->send_fcm($message->customer_title, $message->customer_description, $customer_token);
            
            $response['message'] = "Success";
            $response['status'] = 1;
            return response()->json($response, 200);
        }else{
            $response['message'] = "Invalid order id";
            $response['status'] = 0;
            return response()->json($response, 200);
        }

    }
    
    public function get_labels(){
        $data['labels_en'] = Label::pluck('label_name')->toArray();
        $data['labels_ar'] = Label::pluck('label_name_ar')->toArray();
        //$data = array_merge($data_en, $data_ar);
        return response()->json([
            "result" => $data,
            "count" => count($data),
            "message" => 'Success',
            "status" => 1
        ]);
    }
	
	public function check_order_count(Request $request){
		
		$input = $request->all();
        $validator = Validator::make($input, [
            'pickup_date' => 'required',
            'pickup_time' => 'required',
			'delivery_date' => 'required',
            'delivery_time' => 'required'
        ]);
		
		if($validator->fails()) {
            return $this->sendError($validator->errors());
        }
		
		$max_order_per_hour = AppSetting::where('id',1)->value('max_order_per_hour');
		
		$input['delivery_date'] = date('Y-m-d', strtotime($input['delivery_date']));
        $input['pickup_date'] = date('Y-m-d', strtotime($input['pickup_date']));
		
		$max_order_delivery_date = Order::where('delivery_date',$input['delivery_date'])->where('delivery_time',$input['delivery_time'])->count();
		$max_order_pickup_date = Order::where('pickup_date',$input['pickup_date'])->where('pickup_time',$input['pickup_time'])->count();
		
		if($max_order_pickup_date >= $max_order_per_hour){
			return response()->json([
				"message" => 'maximum orders reached for selected pickup slot',
				"status" => 0
			]);
		}else if($max_order_delivery_date >= $max_order_per_hour){
			return response()->json([
				"message" => 'maximum orders reached for selected delivery slot',
				"status" => 0
			]);
		}
		
		return response()->json([
			"message" => 'Success',
			"status" => 1
		]);
	}
	
	public function check_cards(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
            'customer_id' => 'required'
        ]);
        
        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }
        
        $data =  CustomerCard::where('customer_id',$input['customer_id'])->where('is_default',1)->first();

        if(is_object($data)){
            return response()->json([
                "message" => 'Success',
                "status" => 1
            ]);
        }else{
            return response()->json([
            "message" => 'Sorry no cards found',
            "status" => 0
        ]);
        }
    }
    
    public function add_to_cart(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
            'service_id' => 'required',
            'service_name' => 'required',
            'dara' => 'required'
        ]);
        
        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }
        echo "hi";
        if($input['is_category'] == 1){
          //this.product(data);
        }else{
          $cart_items = Session::get('cart_items');
          $product_data = [
            'service_id' => $input['service_id'],
            'service_name' => $input['service_name'],
            'category' => $input['category']
          ];
          $cart_items[$input['service_id']] = $product_data;
          Session::put('cart_items', $cart_items);
        } 
    }
}
