<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class SendEmployerStatus implements ShouldQueue
{
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	protected $no, $status;

	/**
	 * Create a new job instance.
	 *
	 * @return void
	 */
	public function __construct($no, $status)
	{
		$this->no = $no;
		$this->status = $status;
	}

	/**
	 * Execute the job.
	 *
	 * @return void
	 */
	public function handle()
	{
		Http::withHeaders([
			'Authorization' => "Bearer " . env('SMS_TOKEN'),
		])->get("https://sms.msegs.in/api/send-sms", [
			'template_id' => "1407165605945647836",
			'message' => "Dear Employer, your registration on EmpEx portal has been $this->status.",
			'recipient' => $this->no
		]);
	}
}
