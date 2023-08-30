<?php

namespace App\Jobs;

use App\Models\BasicInfo;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class NCSBeforeApiSMS implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // info('before api');
        $date = date('Y-m-d', strtotime('2023-03-18'));
        $contacts = BasicInfo::query()->where('status', 'Approved')->whereNotNull('employment_no')->whereDate('updated_at', '<', $date)->get()->map(function (BasicInfo $model) {
            info('notified' . $model->id);
            RegisterJobseekerToNcs::dispatch($model->employment_no, $model)->delay(now()->addSeconds(5));
        });
    }
}
