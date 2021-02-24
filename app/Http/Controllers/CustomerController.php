<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Location;
use App\CustomerCard;
use App\CustomerWalletHistory;
use Validator;
use Illuminate\Support\Facades\Hash;
use Cartalyst\Stripe\Stripe;
use Omnipay\Omnipay;
use Omnipay\Common\CreditCard;
class CustomerController extends Controller
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
            'customer_name' => 'required',
            'phone_number' => 'required|numeric|digits_between:9,20|unique:customers,phone_number',
            'email' => 'required|email|regex:/^[a-zA-Z]{1}/|unique:customers,email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }

        $options = [
            'cost' => 12,
        ];
        $input['password'] = password_hash($input["password"], PASSWORD_DEFAULT, $options);
        $input['status'] = 1;
  
        $customer = Customer::create($input);

        if (is_object($customer)) {
            return response()->json([
                "result" => $customer,
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
        $validator = Validator::make($input, [
            'id' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }

        $result = Customer::select('id', 'customer_name','phone_number','email','profile_picture','status')->where('id',$id)->first();

        if (is_object($result)) {
            return response()->json([
                "result" => $result,
                "message" => 'Success',
                "status" => 1
            ]);
        } else {
            return response()->json([
                "message" => 'Sorry, something went wrong...',
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
        $validator = Validator::make($input, [
            'customer_name' => 'required',
            'last_name' => 'required',
            'phone_number' => 'required|numeric|unique:customers,id,'.$id,
            'email' => 'required|email|unique:customers,id,'.$id
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }
        if($request->password){
            $options = [
                'cost' => 12,
            ];
            $input['password'] = password_hash($input["password"], PASSWORD_DEFAULT, $options);
            $input['status'] = 1;
        }else{
            unset($input['password']);
        }

        if (Customer::where('id',$id)->update($input)) {
            return response()->json([
                "result" => Customer::select('id', 'customer_name','phone_number','email','profile_picture','status')->where('id',$id)->first(),
                "message" => 'Success',
                "status" => 1
            ]);
        } else {
            return response()->json([
                "message" => 'Sorry, something went wrong...',
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
    public function destroy($id)
    {
        //
    }

    public function login(Request $request){

        $input = $request->all();
        $validator = Validator::make($input, [
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }

        $credentials = request(['email', 'password']);
        $customer = Customer::where('email',$credentials['email'])->first();

        if (!($customer)) {
            return response()->json([
                "message" => 'Invalid email',
                "status" => 0
            ]);
        }
        
        if (Hash::check($credentials['password'], $customer->password)) {
            if($customer->status == 1){
                Customer::where('id',$customer->id)->update([ 'fcm_token' => $input['fcm_token']]);
                return response()->json([
                    "result" => $customer,
                    "message" => 'Success',
                    "status" => 1
                ]);   
            }else{
                return response()->json([
                    "message" => 'Your account has been blocked',
                    "status" => 0
                ]);
            }
        }else{
            return response()->json([
                "message" => 'Invalid password',
                "status" => 0
            ]);
        }

    }

    public function profile_picture(Request $request){

        $input = $request->all();
        $validator = Validator::make($input, [
            'customer_id' => 'required',
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }

        if ($request->hasFile('profile_picture')) {
            $image = $request->file('profile_picture');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/images');
            $image->move($destinationPath, $name);
            if(Customer::where('id',$input['customer_id'])->update([ 'profile_picture' => 'images/'.$name ])){
                return response()->json([
                    "result" => Customer::select('id', 'customer_name','phone_number','email','profile_picture','status')->where('id',$input['customer_id'])->first(),
                    "message" => 'Success',
                    "status" => 1
                ]);
            }else{
                return response()->json([
                    "message" => 'Sorry something went wrong...',
                    "status" => 0
                ]);
            }
        }

    }

    public function forgot_password(Request $request){

        $input = $request->all();
        $validator = Validator::make($input, [
            'email' => 'required|email|regex:/^[a-zA-Z]{1}/',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }

        $customer = Customer::where('email',$input['email'])->first();
        if(is_object($customer)){
            $otp = rand(1000,9999);
            Customer::where('id',$customer->id)->update(['otp'=> $otp ]);
            $mail_header = array("otp" => $otp);
            $this->send_mail($mail_header,'Reset Password',$input['email']);
            return response()->json([
                "result" => Customer::select('id', 'otp')->where('id',$customer->id)->first(),
                "message" => 'Success',
                "status" => 1
            ]);
        }else{
            return response()->json([
                "message" => 'Invalid email address',
                "status" => 0
            ]);
        }
        
    }

    public function reset_password(Request $request){

        $input = $request->all();
        $validator = Validator::make($input, [
            'id' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }

        $options = [
            'cost' => 12,
        ];
        $input['password'] = password_hash($input["password"], PASSWORD_DEFAULT, $options);

        if(Customer::where('id',$input['id'])->update($input)){
            return response()->json([
                "message" => 'Success',
                "status" => 1
            ]);
        }else{
            return response()->json([
                "message" => 'Invalid email address',
                "status" => 0
            ]);
        }
    }
        
    public function customer_wallet(Request $request){
        
        $input = $request->all();
        $validator = Validator::make($input, [
            'id' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }
        
        $data['wallet_amount'] = Customer::where('id',$input['id'])->value('wallet');
        
        $data['wallets'] = CustomerWalletHistory::where('customer_id',$input['id'])->get();
        
        if($data){
            return response()->json([
                "result" => $data,
                "count" => count($data),
                "message" => 'Success',
                "status" => 1
            ]);
        }else{
            return response()->json([
                "message" => 'Something went wrong',
                "status" => 0
            ]);
        }
    }
    
    public function add_wallet(Request $request){
        
        $input = $request->all();
        $validator = Validator::make($input, [
            'customer_id' => 'required',
            'amount' => 'required'
            
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }
        
        CustomerWalletHistory::create([ 'customer_id' => $input['customer_id'], 'type' => 1, 'message' => 'Successfully added to your wallet', 'message_ar' => 'تم الإضافة إلى محفظتك بنجاح','amount' => $input['amount']]);
        
        $old_wallet_amount = Customer::where('id',$input['customer_id'])->value('wallet');
        $new_wallet = $input['amount'] + $old_wallet_amount;
        Customer::where('id',$input['customer_id'])->update([ 'wallet' => $new_wallet]);
        
        return response()->json([
            "message" => 'Success',
            "status" => 1
        ]);
            
    }
    
    public function get_cards(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
            'customer_id' => 'required'
        ]);
        
        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }
        
        $data =  CustomerCard::where('customer_id',$input['customer_id'])->get();
        return response()->json([
            "result" => $data,
            "message" => 'Success',
            "status" => 1
        ]);
    }
    
    public function delete_card(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
            'customer_id' => 'required',
            'card_id' => 'required'
        ]);
        
        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }
        
        $gateway = OmniPay::create('SagePay\Direct');
        $gateway->setVendor('hellolaundry');
        $gateway->setTestMode(env('SAGEPAY_TEST_MODE'));
        
        $card_token = CustomerCard::where('id',$input['card_id'])->value('card_token');
        
        $gateway = OmniPay::create('SagePay\Direct');
        $gateway->setVendor('hellolaundry');
        $gateway->setTestMode(env('SAGEPAY_TEST_MODE'));
        
        $request = $gateway->deleteCard([
            'cardReference' => $card_token,
        ]);
        
        $response = $request->send();
        
        if ($response->isSuccessful()) {
            CustomerCard::where('id',$input['card_id'])->delete();
            $message = $response->getMessage();
            
            $default_card = CustomerCard::where('customer_id',$input['customer_id'])->where('is_default',1)->first();
            if(!is_object($default_card)){
                $last_card = CustomerCard::where('customer_id',$input['customer_id'])->orderBy('id','DESC')->first();
                if(is_object($last_card)){
                    CustomerCard::where('id',$last_card->id)->update([ 'is_default' => 1]);
                }
            }
            
            return response()->json([
                "message" => 'Success',
                "status" => 1
            ]);
        }else{
            return response()->json([
                "message" => 'Sorry something went wrong',
                "status" => 0
            ]);
        }
    }
    
    public function add_card(Request $request){
        $gateway = OmniPay::create('SagePay\Direct');
        $gateway->setVendor('hellolaundry');
        $gateway->setTestMode(env('SAGEPAY_TEST_MODE'));
        
        $input = $request->all();
        $validator = Validator::make($input, [
            'customer_id' => 'required',
            'number' => 'required',
            'exp_month' => 'required',
            'cvc' => 'required',
            'exp_year' => 'required'
            
        ]);
        
        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }
        
        $customer_name = Customer::where('id',$input['customer_id'])->value('customer_name');
        
        $card = new CreditCard([
            'firstName' => $customer_name,
            'lastName' => $customer_name,
            'number' => $input['number'],
            'expiryMonth' => $input['exp_month'],
            'expiryYear' => $input['exp_year'],
            'cvv' => $input['cvc'],
        ]);

        $request = $gateway->createCard([
            'currency' => 'GBP',
            'card' => $card,
        ]);


        $response = $request->send();
        
        if ($response->isSuccessful()) {
            //$cardReference = $response->getCardReference();
            // or if you prefer to treat it as a single-use token:
            $token = $response->getCardReference();
            
            $data['customer_id'] = $input['customer_id'];
            $data['card_token'] = $token;
            $data['last_four'] = substr($input['number'],strlen($input['number'])-4,4);
            $data['is_default'] = 1;
            CustomerCard::create($data);
            
            CustomerCard::where('customer_id','=',$input['customer_id'])->where('card_token','!=',$token)->update([ 'is_default' => 0 ]);
        
            return response()->json([
                "message" => 'Success',
                "status" => 1
            ]);
        
        }else{
            return response()->json([
                "message" => 'Sorry something went wrong',
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
    
    public function test_sage(){
        $gateway = OmniPay::create('SagePay\Direct');
        $gateway->setVendor('hellolaundry');
        $gateway->setTestMode(env('SAGEPAY_TEST_MODE'));
        $gateway->setBillingForShipping(true);
        
        $transactionId = time();
        
        $card = new CreditCard([
            'billingFirstName' => 'Joe',
            'billingLastName' => 'Bloggs',
            'billingAddress1' => '88',
            //'billingAddress2' => '88',
            //'billingState' => '',
            'billingCity' => 'Billing City',
            'billingPostcode' => '412',
            'billingCountry' => 'GB',
            //'billingPhone' => '01234 567 890',
            //
            'email' =>  'test@example.com',
            'clientIp' => $this->get_client_ip(),
            
        ]);
        
        $response = $gateway->purchase([
            'amount' => '9.99',
            'currency' => 'GBP',
            'card' => $card,
            'notifyUrl' => 'http://example.com/your/notify.php',
            'transactionId' => $transactionId,
            'description' => 'Mandatory description',
            // 'items' => $items,
            'cardReference' => '{E6E9F200-EE39-C87B-CB0D-A17E622A7620}',
            // 'surchargeXml' => $surchargeXml,
            // 'token' => $token,
            // 'cardReference' => $cardReference,
            // 'useAuthenticate' => true,
        ])->send();
        
        if ($response->isSuccessful()) {
            
            print_r($response->getMessage());
            // The transaction is complete and successful and no further action is needed.
            // This may happen if a cardReference has been supplied, having captured
            // the card reference with a CVV and using it for the first time. The CVV will
            // only be kept by the gateway for this first authorization. This also assumes
            // 3D Secure is turned off.
        } elseif ($response->isRedirect()) {
            // Redirect to offsite payment gateway to capture the users credit card
            // details.
            // If a cardReference was provided, then only the CVV will be asked for.
            // 3D Secure will be performed here too, if enabled.
            // Once the user is redirected to the gateway, the results will be POSTed
            // to the [notification handler](#sage-pay-server-notification-handler).
            // The handler will then inform the gateway where to finally return the user
            // to on the merchant site.
            $response->redirect();
        } else {
            // Something went wrong; get the message.
            // The error may be a simple validation error on the address details.
            // Catch those and allow the user to correct the details and submit again.
            // This is a particular pain point of Sage Pay Server.
            $reason = $response->getMessage();
            echo $reason;
        }

    }
    
    public function get_client_ip()
    {
          $ipaddress = '';
          if (getenv('HTTP_CLIENT_IP'))
              $ipaddress = getenv('HTTP_CLIENT_IP');
          else if(getenv('HTTP_X_FORWARDED_FOR'))
              $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
          else if(getenv('HTTP_X_FORWARDED'))
              $ipaddress = getenv('HTTP_X_FORWARDED');
          else if(getenv('HTTP_FORWARDED_FOR'))
              $ipaddress = getenv('HTTP_FORWARDED_FOR');
          else if(getenv('HTTP_FORWARDED'))
              $ipaddress = getenv('HTTP_FORWARDED');
          else if(getenv('REMOTE_ADDR'))
              $ipaddress = getenv('REMOTE_ADDR');
          else
              $ipaddress = 'UNKNOWN';
    
          return $ipaddress;
    }

    public function customer_availability(Request $request){
        echo "Hello";
        print_r($request);
        $input = $request->all();
        print_r($input);
        // $customer = Customer::where('email',$input['email'])->first();
        // print_r($customer);
        // if($customer){
        //     return array("msg"=>"Customer already Exist");
        // }

    }
    
    public function check_pincode(Request $request){

        $input = $request->all();
        $validator = Validator::make($input, [
            'pin_code' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }

       
        $pincode = Location::where('pin_code',$input['pin_code'])->first();
        if($pincode){
            return response()->json([
                "message" => 'Success',
                "status" => 1
            ]);
        }else{
            return response()->json([
                "message" => 'Services not available in this location',
                "status" => 0
            ]);
        }
    }
    
    public function direct_payment(Request $request){
        $gateway = OmniPay::create('SagePay\Direct')->initialize([
            'vendor' => 'hellolaundry',
            'testMode' => env('SAGEPAY_TEST_MODE'),
        ]);

        $input = $request->all();
        $validator = Validator::make($input, [
            'customer_id' => 'required',
            'number' => 'required',
            'exp_month' => 'required',
            'cvc' => 'required',
            'exp_year' => 'required',
            'amount' => 'required'
        ]);
        
        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }
        
        $customer_name = Customer::where('id',$input['customer_id'])->value('customer_name');

        $card = new CreditCard([
            'firstName' => $customer_name,
            'lastName' => $customer_name,
            'number' => $input['number'],
            'expiryMonth' => $input['exp_month'],
            'expiryYear' => $input['exp_year'],
            'cvv' => $input['cvc'],
            'billingFirstName' => $customer_name,
            'billingLastName' => $customer_name,
            'billingAddress1' => '88',
            'billingCity' => 'Billing City',
            'billingPostcode' => '412',
            'billingCountry' => 'GB',
            'shippingFirstName' => $customer_name,
            'shippingLastName' => $customer_name,
            'shippingAddress1' => '88',
            'shippingCity' => 'Billing City',
            'shippingPostcode' => '412',
            'shippingCountry' => 'GB',
            'email' =>  'test@example.com',
            'clientIp' => $this->get_client_ip(),
        ]);
    
        $requestMessage = $gateway->purchase([
            'amount' => $input['amount'],
            'currency' => 'GBP',
            'card' => $card,
            'transactionId' => time().$customer_name,
            'description' => 'Hellolaundry purchase',
            
            'returnUrl' => env('APP_URL').'/payment/success',
        ]);
        
        $responseMessage = $requestMessage->send();
        
        if($responseMessage->isSuccessful()){
            return response()->json([
                "message" => 'Success',
                "status" => 1
            ]);
        }else{
            return response()->json([
                "message" => 'Failed',
                "status" => 0
            ]);
        }
    }
}
