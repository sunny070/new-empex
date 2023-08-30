<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class SendOtp implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $no, $otp;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($no, $otp)
    {
        $this->no = $no;
        $this->otp = $otp;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $resonse = Http::withHeaders([
            'Authorization' => "Bearer " . env('SMS_TOKEN'),
        ])->get("https://sms.msegs.in/api/send-otp", [
            'template_id' => "1407164818910899033",
            'message' => "Your OTP for EmpEx is $this->otp . It will be valid for 30 Minutes",
            'recipient' => $this->no
        ]);

        info($resonse->body());
    }

    public function failed($exception)
    {
        info($exception);
    }
}
