<?php

namespace App\Http\Livewire\Web\Auth;

use App\Jobs\SendStatusSms;
use App\Models\BasicInfo;
use App\Models\OnGoingApplication;
use App\Models\Renew;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\URL;
use Livewire\Component;

class RenewCard extends Component
{
	public $info, $daysLeft;

	public function makePayment()
	{
		$orderId = 'empex-' . now()->timestamp;
		$callbackUrl = URL::to('/') . '/auth/employee/renew-response-handler';
		$amount = 20;
		$departmentId = 1;
		$customer = 'Empex';

		$customer = json_encode($customer);

		if (env('APP_ENV') == 'local') {
			$url = 'https://paymentgw.mizoram.gov.in/api/initiate-test-payment'; // test
		} else {
			$url = 'https://paymentgw.mizoram.gov.in/api/initiate-payment'; // prod
		}

		$client = new Client();
		$response = $client->request('POST', $url, [
			'form_params' => [
				'callback_url' => $callbackUrl,
				'order_id' => $orderId,
				'amount' => $amount,
				'department_id' => $departmentId,
				'customer' => $customer,
				'shouldSplit' => false
			]
		]);

		$response = json_decode($response->getBody());

		return redirect($response);
	}

	public function mount()
	{
		$this->info = BasicInfo::where('user_id', auth()->id())->where('status', 'Approved')->latest('updated_at')->first();

		$validDate = Carbon::parse($this->info->card_valid_till);

		$result = now()->diffInDays($validDate, false);

		$s = '';
		if ($result < 0) {
			$this->daysLeft = '<span class="text-empex-red">Expired</span>';
		} else {
			if ($result >= 10) {
				$s = 's';
			}
			$this->daysLeft = '<span>' . $result . ' Day' . $s . '</span>';
		}
	}

	public function render()
	{
		return view('livewire.web.auth.renew-card');
	}
}
