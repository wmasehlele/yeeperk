<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App;
use Validator;
use Log;


class AccountsController extends Controller
{
	public function postApiCheckCustomer(Request $request){
        $data = $request->all();
        if (!isset($data["work_email"])){
            App::abort(400, "Provide Email");
        }
        $validator = Validator::make($data, ['work_email' => 'required|email|max:50']);
        if ($validator->fails()){
            return ["status"=>false, "message"=>"Invalid email address format", "errors"=>$validator->errors()];
        }
        $customer = DB::table('customers')
            ->leftjoin('employers','customers.employer_id','=','customers.id')
            ->select('customers.id')
            ->where('customers.work_email','=', $data["work_email"])
            ->first();
        if (count($customer) < 1){
            return ["status"=>false, "message"=>"We do not have record of this email"];
        }
        return ["status"=>true, "message"=>"Email address available"];
    }

    public function postApiAddCustomer(Request $request){
        $data = $request->all();
        $validator = Validator::make($data,[
            'name' => 'required',
            'surname' => 'required',
            'contact_number' => 'required|numeric',
            'password' => 'required',
            'email' => 'required|email'
        ]);
        if ($validator->fails()){
            $message = $validator->errors();
            return ["status"=>false, "message"=>"", "errors"=>$message->first()];
        }
        $customer = DB::table('customers')
            ->select('customers.id')
            ->where('customers.work_email','=',$data["email"])
            ->get();
        if (count($customer) < 1){
            return ["status"=>false, "message"=>"Failed, Unknown email address"];
        }
        $customer_id = 0;
        foreach($customer as $cust){
            $customer_id = $cust->id;
        }
        DB::beginTransaction();
        $update_customer = App\Customer::find($customer_id);
        $update_customer->membership_code = App\Common::GetMembershipNumber();
        $update_customer->name = $data["name"];
        $update_customer->surname = $data["surname"];
        $update_customer->cell_number = $data["contact_number"];
        $update_customer->work_email = $data["email"];
        if(!$update_customer->save()){
            return ["status"=>false, "message"=>"Failed, Please try again"];
        }
        $user = new App\User();
        $user->name = $data["name"];
        $user->user_id = $customer_id;
        $user->email = $data["email"];
        $user->password = bcrypt($data["password"]);
        try{
           if(!$user->save()){
                DB::rollBack();
                return ["status"=>false, "message"=>"Failed, Please try again"];
            }
        }catch(\Exception $e){
            DB::rollBack();
            return ["status"=>false, "message"=>"Failed, User already exist"];
        }
        
        $mailData = [];
        $mailData["subject"] = "Account registration";
        $mailData["emailTo"] = $user->email;
        $mailData["view"] = "register";
        $mailData["customer_names"] = $user->name;
        $mailData["membership_code"] = $update_customer->membership_code;
        $mailData["additional_msg"] = $user->email;
        if (!App\Common::sendClientEmail($mailData)){
            DB::rollBack();
            return ["status"=>false, "message"=>"Failed, We failed to deliver your email please try again"]; 	    
        } else {
            DB::commit();
            return ["status"=>true, "message"=>"Account created successfully"];               
        }
    }

    public function postApiDoLogin(Request $request){
        $data = $request->all();
        $validator = Validator::make($data,[
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if ($validator->fails()){
            $message = $validator->errors();
            return ["status"=>false, "message"=>"", "errors"=>$message->first()];
        }
        $login = new Auth\AuthController();
        $status = \App\User::where('email','=',$data["email"])->first();
        if($status->active != 1){
            \Auth::logout();
            return ["status"=>false, "message"=>"Your account is inactive"];
        }
        if (!$login->doLogin($data)){
            Log::info("Login attempt by".$data["email"]);
            return ["status"=>false, "message"=>"Incorrect credentials"];
        }
        return view('yeeperks');//["status"=>true, "message"=>"Authentication Successful"];
    }

    public function getApiLoadProfile(){
        $customer_id = \Auth::user()->user_id;
        $customer = DB::table('customers')
          ->leftjoin('employers','customers.employer_id','=','employers.id')
          ->select('customers.*','employers.company_name')
          ->where('customers.id','=',$customer_id)
          ->first();
        return json_encode($customer);
    }

    public function putApiUpdateProfile(Request $request){
        $data = $request->all();
        $validator = Validator::make($data,[
            'name' => 'required',
            'surname' => 'required',
            'work_tel' => 'numeric',
            'cell_number' => 'required|numeric',
            'work_email' => 'required|email',
            'personal_email' => 'email',
            'date_of_birth' => 'required|date'
        ]);
        if ($validator->fails()){
            $message = $validator->errors();
            return ["status"=>false, "message"=>"", "errors"=>$message->first()];
        }
        $customer_id = \Auth::user()->user_id;
        $customer = \App\Customer::find($customer_id);
        $customer->name = $data["name"];
        $customer->surname = $data["surname"];
        $customer->cell_number = $data["cell_number"];
        $customer->work_email = $data["work_email"];
        $customer->personal_email = $data["personal_email"];
        $customer->work_tel = $data["work_tel"];
        $customer->date_of_birth = $data["date_of_birth"];
        $customer->occupation = $data["occupation"];
        $customer->gender = $data["gender"];
        if(!$customer->save()){
            return ["status"=>false, "message"=>"Failed, Please try again"];
        }
        return ["status"=>true, "message"=>"Profile Updated successfully"];
    }

    public function postApiResetPassword(Request $request){
        $data = $request->all();
        $validator = Validator::make($data,[
            'email' => 'required|email'
        ]);
        if ($validator->fails()){
            $message = $validator->errors();
            return ["status"=>false, "message"=>"", "errors"=>$message->first()];
        }
        $status = \App\User::where('email','=',$data["email"])->first();
        if(count($status) < 1){
            return ["status"=>false, "message"=>"Unknown email"];
        }
        $resetPassword = new Auth\PasswordController();
        return ["status"=>true, "message"=>"Visit your email for rest link."];
    }

    public function postApiCheckLogIn(){
        if (!\Auth::check()){
          return ["status"=>false, "message"=>"NO session"];
        }
        return ["status"=>true, "message"=>"Session active"];
    }	
}
