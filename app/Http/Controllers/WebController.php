<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Validator;
use App;
use Mail;

class WebController extends Controller
{
    public function postApiWebContact(Request $request){
        $data = $request->all();
        $validator = validator::make($data,[
            'names'=>'required',
            'contact_number'=>'required',
            'email'=>'required|email',
            'client_type'=>'required',
            'reason_for_contact'=>'required',
            'message'=>'required'
        ]);
        if ($validator->fails()){
            $message = $validator->errors();
            return ["status"=>false, "message"=>"", "errors"=>$message->first()];
        }
        
        $newContact = new App\WebContact();
        $newContact->name = $data["names"];
        $newContact->email = $data["email"];
        $newContact->contact_number = $data["contact_number"];
        // $newContact->company_name = $data["company_name"];
        // $newContact->number_of_employees = $data["number_of_employees"];
        $newContact->client_type = $data["client_type"];
        $newContact->reason_for_contact = $data["reason_for_contact"];
        if (isset($data["activate_trial"])){
        	$newContact->activate_trial = $data["activate_trial"];
        } else {
        	$data["activate_trial"] = 0;
        	$newContact->activate_trial = 0;        	
        }
        $newContact->message = $data["message"];
        if (!$newContact->save()){
            return ["status"=>false, "message"=>"Failed, Please try again"];
        }
        $mailData = [];
        $mailData["subject"] = "YeePerk, web contact";
        $mailData["emailTo"] = $newContact->email;
        $mailData["view"] = "web-contact";
        $mailData["customer_names"] = $newContact->name;
        $mailData["membership_code"] = "";
        $mailData["additional_msg"] = "";
        App\Common::sendClientEmail($mailData);
        
        $text = "Dear Honcho"
        		."\n".""
        		."\n"."A communication from a potential yeeperk client."
        		."\n".""
        		."\n"."Here are the details."
        		."\n"."Names: ".$data["names"]
        		."\n"."Email: ".$data["email"]
        		."\n"."Phone: ".$data["contact_number"]
        		."\n"."Type: ".$data["client_type"]
        		."\n"."Trial request: ".$data["activate_trial"]
        		."\n"."Reason: ".$data["reason_for_contact"]
        		."\n"."Message: ".$data["message"]
        		."\n".""
        		."\n"."Support Team";
		Mail::raw($text, function ($message) {
		    $message->from('info@yeeperk.co.za', 'YeePerk, Contact page');
		    $message->to('tshiamo@yeeperk.co.za')->cc('william@yeeperk.co.za');
		    $message->subject('YeePerk, Contact page');
		});        
        return ["status"=>true, "message"=>"Thank you, we will contact you soon."];
    }
}
