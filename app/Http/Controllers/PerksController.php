<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PerksController extends Controller
{
	public function getApiLoadPerks(){
        $start_date = "2016-05-17";
        // $start_date = Carbon::now();
        // $start_date->toDateString());
        $perks = DB::table('perks')
            ->leftjoin('merchants','perks.merchant_id','=','merchants.id')
            ->leftjoin('categories','perks.category_id','=','categories.id')
            ->select('perks.*','merchants.company_name','merchants.status','merchants.logo_link','categories.description AS cat_desc')
            ->where('merchants.status','=','1')
            //->where('perks.end_date','>=',$start_date)
            ->orderBy('perks.benefits', 'desc')
            ->get();
        $categories = DB::table('perks')
            ->leftjoin('categories','perks.category_id','=','categories.id')
            ->select('categories.id','categories.description','categories.fa_icon_name')
            //->where('perks.end_date','>=',$start_date)
            ->groupBy('perks.category_id')
            ->orderBy('categories.id', 'desc')
            ->get();
        return array("perks" => $perks, "categories" => $categories);
    }

    public function postApiTransaction(Request $request){
    		$data = $request->all();
    		if (!isset($data["id"])){
    			return ["status"=>false, "message"=>"No Perk selected"];
    		}
    		$customer_id = \Auth::user()->user_id;
   		
        $tansaction = new App\Transaction();
        $tansaction->transaction_date = Carbon::now()->toDateString();
        $tansaction->redemption_code = "SAMPLE45186";
        $tansaction->customer_id = $customer_id;
        $tansaction->perk_id = $data["id"];
        $tansaction->status = 1;
        if(!$tansaction->save()){
            return ["status"=>false, "message"=>"Failed to record transactioin"];
        }
        $transaction_id = $tansaction->id;
        $customer = App\Customer::find($customer_id);
        $perk = App\Perk::find($data["id"]);
        $merchant = App\Merchant::find($perk->merchant_id);
        $mailData = [];
        $mailData["subject"] = "YeePerk, Transaction";
        $mailData["emailTo"] = $customer->work_email;
        $mailData["view"] = "transaction";
        $mailData["perk"] = $perk->benefits;
        $mailData["merchant_name"] = $merchant->company_name; 
        if ($perk->redeem_method == '1'){
        	$mailData["merchant_address"] = "Visit ".$merchant->company_name." online at "."url: ".$perk->redeem_link;
        }else{ 
        $mailData["merchant_address"] = $merchant->street_address_1.", ".$merchant->region.", ".$merchant->city.", ".$merchant->postal_code;
        }
        $mailData["t_and_c"] = $perk->t_and_c_text." ".$perk->t_and_c_link;
        $mailData["customer_names"] = $customer->name ." ".$customer->surname;
        $mailData["membership_code"] = $customer->membership_code . " Mechant code : ".$merchant->merchant_code." ";
        $mailData["additional_msg"] = "";
        App\Common::sendClientEmail($mailData);
        return ["status"=>true, "message"=>""];
  	}

    public function getApiClientTransactions_demo(Request $request){
    		$data = $request->all();
    		if (!isset($data["membership_code"])){
    			   return ["status"=>false, "message"=>"Unknown memebership code"];
    		}
        $customer = App\Customer::where('membership_code',$data["membership_code"])->first();
        $transations = App\Transaction::where('customer_id',$customer->id)->where('status',1)->get();
        if (count($transations) < 0){
            return ["status"=>false, "message"=>"No transactions for the memebership code :".$data["membership_code"]];
        }
        return ["status"=>true, "message"=>"", 'transations'=>$transations];
  	}

    public function putApiClientTransactions_(Request $request){
        $data = $request->all();
        if (!isset($data["membership_code"])){
             return ["status"=>false, "message"=>"Unknown memebership code"];
        }
        $customer = App\Customer::where('membership_code',$data["membership_code"])->first();
        $transations = App\Transaction::where('customer_id',$customer->id)->where('status',1)->get();
        if (count($transations) < 0){
            return ["status"=>false, "message"=>"No transactions for the memebership code :".$data["membership_code"]];
        }
        foreach($transations as $trans){
            $trans->status = 0;
            $trans->save();
        }
        return ["status"=>true, "message"=>""];
    }
    
    public function getApiClientTransactions(Request $request){
    	$data = $request->all();
    		// if (!isset($data["membership_code"])){
    			   // return ["status"=>false, "message"=>"Unknown memebership code"];
    		// }
        // $customer = App\Customer::where('membership_code',$data["membership_code"])->first();
        // $transactions = App\Transaction::where('customer_id',$customer->id)->where('status',1)->get();
        // if (count($transactions) < 0){
            // return ["status"=>false, "message"=>"No transactions for the membership code :".$data["membership_code"]];
        // }
        // return ["status"=>true, "message"=>"", 'customer'=>$customer, 'transactions'=>$transactions];
		$transactions = DB::table('transactions')
			->leftjoin('perks','transactions.perk_id','=','perks.id')
			->leftjoin('merchants','perks.merchant_id','=','merchants.id')
			->leftjoin('customers','transactions.customer_id','=','customers.id')
			->leftjoin('employers','customers.employer_id','=','employers.id')
			->select('transactions.id','perks.title','perks.benefits','transactions.redemption_code','transactions.transaction_date','customers.name',
					 'customers.surname','customers.membership_code','customers.membership_status','customers.cell_number','employers.company_name')
			->where('customers.membership_status','=',1)
			->where('merchants.merchant_code','=',$data['merchant_code'])
			->where('transactions.status','=',1)
			->get();
		$customer = App\Customer::where('membership_code',$data['membership_code'])->first();
		$employer = App\Employer::find($customer->employer_id);
		$customer->employer_name = $employer->company_name;
		
		 return array("transactions" => $transactions,'customer'=>$customer);
  	}

    public function putApiClientTransactions(Request $request){
        $data = $request->all();
		$message = "";
        if (!isset($data["membership_code"])){
             return ["status"=>false, "message"=>"Unknown memebership code"];
        }
        $customer = App\Customer::where('membership_code',$data["membership_code"])->first();
        $transations = App\Transaction::where('customer_id',$customer->id)->where('id', $data['transaction_id'])->where('status',1)->get();
		
        if (count($transations) < 0){
            return ["status"=>false, "message"=>"No transactions for the memebership code :".$data["membership_code"]];
        }
        foreach($transations as $trans){
			$trans->status = 0;
			$trans->save();
        }
        return ["status"=>true, "message"=>""];
    }
}
