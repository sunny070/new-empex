<?php

namespace App\Util;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class NewRegistrationCard
{
    const TEMPLATE = "1407167868305358074";



    public static function sendSMS($mobile)
    {



        $response = Http::withHeaders([
            'Authorization' => "Bearer " . env('SMS_TOKEN'),
        ])->get("https://sms.msegs.in/api/send-sms", [
            'template_id' => self::TEMPLATE,
            'message' => 'Your Empex registration card has expired. Kindly renew within 3 months',
            'recipient' => $mobile
        ]);

        Log::info('response sms ' . $response->body());
    }


}
