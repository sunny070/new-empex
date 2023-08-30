<?php

namespace App\Jobs;

use App\Models\UserNco;
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

    protected $link, $nco = [];

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($nco, $link)
    {
        $this->nco = $nco;
        $this->link = $link;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {


        info('count nco start: ');
        $userFamilyNcoList = UserNco::query()->whereHas('user', function ($q) {
            return $q->whereHas('basicInfo', function ($query) {
                return $query->where('status', 'Approved')
                    ->where('card_valid_till', '>=', now());
            });
        })
            ->whereIn('family_id', $this->nco)->with('user')->get();


        $ncoUserToNotify = [];
        foreach ($userFamilyNcoList as $unco) {
            if (!array_key_exists($unco->user_id, $ncoUserToNotify)) {
                $ncoUserToNotify[$unco->user_id] = $unco->user->mobile_no;
            }
        }

        info($userFamilyNcoList);

        if (count($ncoUserToNotify) > 0) {
            $chunks = array_chunk(array_values($ncoUserToNotify), 8);


            foreach ($chunks as $key => $value) {
                $strContacts = implode(",", $value);
                info($strContacts);
                info("link: $this->link");
                Http::withHeaders([
                    'Authorization' => "Bearer " . env('SMS_TOKEN'),
                ])->get("https://sms.msegs.in/api/send-sms", [
                    'template_id' => "1407165475881528751",
                    // 'message' => "Hello applicant, we have a New Job Post related to your Profession on EmpEx Mizoram. Visit $this->link for more details. EGOVMZ",
                    'message' => "Hello applicant, we have a New Job Post related to your Profession on EmpEx Mizoram. Visit empex for more details. EGOVMZ",
                    'recipient' => "$strContacts",
                ]);
            }

            info('finishesd');
        }
    }
}
