<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class SendJobNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $nos, $link;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($nos, $link)
    {
        $this->nos = $nos;
        $this->link = $link;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Http::withHeaders([
        // 	'Authorization' => "Bearer " . env('SMS_TOKEN'),
        // ])->post("https://sms.msegs.in/api/send-bulk", [
        // 	'template_id' => "1407165475881528751",
        // 	'message' => "Hello applicant, we have a New Job Post related to your Profession on EmpEx Mizoram. Visit $this->link for more details. EGOVMZ",
        // 	'recipients' => $this->nos,
        // 	'sender' => 'EGOVMZ'
        // ]);
        $chunks = array_chunk($this->nos, 6);
        info('chunks');
        info($chunks);

        foreach ($chunks as $key => $value) {
            $strContacts = implode(",", $value);
            info($strContacts);
            Http::withHeaders([
                'Authorization' => "Bearer " . env('SMS_TOKEN'),
            ])->get("https://sms.msegs.in/api/send-sms", [
                'template_id' => "1407165475881528751",
                'message' => "Hello applicant, we have a New Job Post related to your Profession on EmpEx Mizoram. Visit $this->link for more details. EGOVMZ",
                'recipient' => "$strContacts",
            ]);
        }
    }
}
