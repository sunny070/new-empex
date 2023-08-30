<?php

namespace App\Console\Commands;

use App\Models\BasicInfo;
use App\Util\ExpireSMS;
use App\Util\ExpireSMSUtil;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ExpireNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'expire:notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send expirey sms notification daily';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {


        Log::info('started auth id: '.auth()->id());

        $test = BasicInfo::query()
        // ->where('user_id', auth()->id())
        ->whereDate('card_valid_till', '<', now())
        ->where('status', 'Approved')
        ->latest('card_valid_till')
        ->doesntHave('expireBasicInfo')

        ->first();

        Log::info('test: '.$test);

        // return;
        //added rj
        $mobiles = BasicInfo::query()
            // ->where('user_id', auth()->id())
            ->whereDate('card_valid_till', '<', now())
            ->where('status', 'Approved')
            ->latest('card_valid_till')
            ->doesntHave('expireBasicInfo')

            ->get()->filter(function (BasicInfo $basic) {

                $this_month = Carbon::parse($basic->card_valid_till); // returns 2019-07-01
                $start_month = Carbon::parse(now()); // returns 2019-06-01
                Log::info('diff: '.$start_month->floatDiffInRealMonths($this_month));

                if (($start_month->floatDiffInRealMonths($this_month)  < 3)) {
                //    return $ino
                }
            });

            Log::info("message");

        // if ($basic) {

        // }
    }
}
