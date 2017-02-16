<?php

namespace App;

use Mail;

class Common{
    public static function sendClientEmail(array $mailData){
        //$data['data'] = $mailData;
        return Mail::send('emails.'.$mailData['view'],$mailData, function($message) use($mailData){
            $message->from('info@yeeperk.co.za');
            $message->to($mailData['emailTo']);
            $message->subject($mailData['subject']);
        });
    }
    public static function GetMembershipNumber(){
        $min = 1;
        $max = 99999;
        $year = date("Y");
        $membershipNumber = "";
        $temp = "";
        $isComplete = false;
        while(!$isComplete){
            $temp = rand($min, $max);
            if(strlen($temp) == 5){
                $membershipNumber = $year.$temp;
                $isComplete = true;
            }
        }
        return $membershipNumber;
    }
}