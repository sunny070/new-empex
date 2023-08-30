<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class SendStatusSms implements ShouldQueue
{
  use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

  protected $no, $type, $status;

  /**
   * Create a new job instance.
   *
   * @return void
   */
  public function __construct($no, $type, $status)
  {
    $this->no = $no;
    $this->type = $type;
    $this->status = $status;
  }

  /**
   * Execute the job.
   *
   * @return void
   */
  public function handle()
  {
    info('no: '.$this->no);
    Http::withHeaders([
      'Authorization' => "Bearer " . env('SMS_TOKEN'),
    ])->get("https://sms.msegs.in/api/send-sms", [
      'template_id' => "1407165097181779187",
      'message' => "Your Empex application to $this->type has been $this->status.",
      'recipient' => $this->no
    ]);
  }
}
