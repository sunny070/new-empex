<?php

namespace App\Jobs;

use App\Models\BasicInfo;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class NotifySMSJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $newCard;

    public function __construct()
    {
        // $this->newCard = $newCard;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // $contacts = collect($this->newCard->pluck('phone_no'))->toArray();
        // $contacts = collect($this->newCard->pluck('phone_no'));


        BasicInfo::query()->where('notify_sms', 'yes')->chunk(5, function ($nos) {
            $contacts = collect($nos->pluck('phone_no'))->toArray();
            $strContacts = implode(",", $contacts);

            info($strContacts);

            $response = Http::withHeaders([
                'Authorization' => "Bearer " . env('SMS_TOKEN'),
            ])->get("https://sms.msegs.in/api/send-sms", [
                'template_id' => "1407167868305358074",
                // 'message' => "Your empex new registration card is generated. Kindly download from https://empex.mizoram.gov.in/auth/employee/enrollment-card -EMPEX",
                'message' => "Your empex new registration card is generated. Kindly download from empex.mizoram.gov.in -EMPEX",
                // 'message' => "Your empex new registration card is generated. Kindly download from \$url -EMPEX",
                'recipient' => "$strContacts"
            ]);

            if($response->ok()) {
                $nos->notify_sms = 'notified';
                $nos->save();
            }

            info('http res: ' . $response->body());

        });
    }


    public function failed($exception)
    {
        info($exception);
    }
}
