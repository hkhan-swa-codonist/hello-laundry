<?php

namespace App\Admin\Controllers;

use App\Customer;
use App\Order;
use App\Address;
use App\DeliveryBoy;
use App\AppSetting;
use App\Label;
use App\OrderItem;
use App\PaymentMethod;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Facades\Admin;
use Illuminate\Support\Facades\DB;
class ViewOrderController extends Controller
{
    public function index($id)
    {
        return Admin::content(function (Content $content) use ($id) {
            $content->header('Order Details');
            $content->description('View');
            $order_details = Order::where('id',$id)->first();
            $app_setting = AppSetting::first();
            $data = array();
            $data['order_id'] = $order_details->order_id;
            $data['customer_name'] = Customer::where('id',$order_details->customer_id)->value('customer_name');
            $data['customer_phone'] = Customer::where('id',$order_details->customer_id)->value('phone_number');
            $data['address'] = Address::where('id',$order_details->address_id)->value('address');
            $data['pickup_date'] = date('d M-Y',strtotime($order_details->pickup_date));
            $data['delivery_date'] = date('d M-Y',strtotime($order_details->delivery_date));
			$data['pickup_time'] = $order_details->pickup_time;
            $data['delivery_time'] = $order_details->delivery_time;
            $data['collected_by'] = (DeliveryBoy::where('id',$order_details->collected_by)->value('delivery_boy_name') != '' ) ? DeliveryBoy::where('id',$order_details->collected_by)->value('delivery_boy_name') : "---" ;
            $data['delivered_by'] = (DeliveryBoy::where('id',$order_details->delivered_by)->value('delivery_boy_name') != '' ) ? DeliveryBoy::where('id',$order_details->delivered_by)->value('delivery_boy_name') : "---" ;
            $data['payment_mode'] = PaymentMethod::where('id',$order_details->payment_mode)->value('payment_mode');
            $data['sub_total'] = $app_setting->default_currency.$order_details->sub_total;
            $data['discount'] =  $app_setting->default_currency.$order_details->discount;
            $data['total'] =  $app_setting->default_currency.$order_details->total;
            $data['status'] =  Label::where('id',$order_details->status)->value('label_name');
            $data['other_requests'] = $order_details->other_requests;
            $data['collection_instructions'] = $order_details->collection_instructions;
            $data['delivery_instructions'] = $order_details->delivery_instructions;
            $order_services = DB::table('order_services')
            ->leftJoin('services', 'services.id', '=', 'order_services.service_id')
            ->select('services.service_name','order_services.category_id')
            ->where('order_services.order_id',$order_details->id)
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
           
            $data['order_services'] = $order_services;
            $content->body(view('admin.view_orders', $data));
        });

    }
}
