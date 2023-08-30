<?php

namespace App\Http\Livewire\Web\Auth;

use App\Jobs\SendStatusSms;
use App\Models\Address;
use App\Models\BasicInfo;
use App\Models\EducationQualification;
use App\Models\Experience;
use App\Models\NcoDetail;
use App\Models\OnGoingApplication;
use App\Models\User;
use App\Models\UserCanRead;
use App\Models\UserCanSpeak;
use App\Models\UserCanWrite;
use App\Models\UserNco;
use App\Models\UserPhysicalChallenge;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\URL;
use Livewire\Component;

class EmployeeDetail extends Component
{
  public $basicInfo, $addresses, $qualifications, $experiences;
  public $langRead, $langWrite, $langSpoken, $physical;

  public $name;
  public $mobile_no;
  public $alreadyPaid = false;

  public $type;

  public $ncoCodeToDisplay;
  public $ncoFamilySelected;

  public function makePayment()
  {
    $orderId = 'empex-' . now()->timestamp;
    $callbackUrl = URL::to('/') . '/auth/employee/response-handler';
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

  public function submit()
  {
    $basic_info = BasicInfo::where('user_id', auth()->id())->latest('updated_at')->first();
    $basic_info->canEdit = 0;
    $basic_info->status = 'Pending';
    $basic_info->notes = null;
    $basic_info->percent_complete = '100';
    $basic_info->save();

    $ongoing = new OnGoingApplication;
    $ongoing->user_id = auth()->id();
    $ongoing->type = 'New Application';
    $ongoing->model_name = 'BasicInfo';
    $ongoing->requested_id = $basic_info->id;
    $ongoing->status = 'Pending';
    $ongoing->color = '#2d9735';
    $ongoing->bg = '#e1ffe3';
    $ongoing->save();

    SendStatusSms::dispatch($basic_info->mobile_no, 'apply for employment card', 'received')->delay(30);

    return redirect(route('auth.employee.confirmation'));
  }

  public function back()
  {
    $this->emit('stepDecrement');
  }

  public function dashboard()
  {
    return redirect(route('auth.dashboard'));
  }

  public function updateUser()
  {
    $this->validate([
      'name' => 'required',
      'mobile_no' => 'required|digits:10|unique:users,mobile_no,' . auth()->id()
    ]);

    $user = User::findOrFail(auth()->id());
    $user->name = $this->name;
    $user->mobile_no = $this->mobile_no;
    $user->save();

    session()->flash('updated', 'Profile updated successfully!');
  }

  public function mount()
  {
    $this->name = auth()->user()->name;
    $this->mobile_no = auth()->user()->mobile_no;

    $this->basicInfo = BasicInfo::where('user_id', auth()->id())->latest('updated_at')->first();
    if ($this->basicInfo && $this->basicInfo->is_paid == 1) {
      $this->alreadyPaid = true;
    }

    $this->addresses = Address::with('state', 'district', 'rdBlock', 'policeStation', 'postOffice')->where('user_id', auth()->id())->get();

    $this->qualifications = EducationQualification::with('qualification', 'subject', 'majorCore')->where('user_id', auth()->id())->get();

    $this->experiences = Experience::where('user_id', auth()->id())->get();

    $authPreferNcoCode = UserNco::where('user_id', auth()->id())->where('nco_code_display', '!=', null)->value('nco_code_display');
    $this->ncoCodeToDisplay = NcoDetail::where('id', $authPreferNcoCode)->first();
    $this->ncoFamilySelected = UserNco::where('user_id', auth()->id())->orderBy('family_id', 'ASC')->get()->groupBy('family_id')->toArray();

    // user read language
    $readLang = UserCanRead::with('language')->where('user_id', auth()->id())->get();
    foreach ($readLang as $read) {
      $this->langRead .= $read->language->name;
      if ($readLang->last() != $read) {
        $this->langRead .= ', ';
      }
    }

    // user write language
    $writeLang = UserCanWrite::with('language')->where('user_id', auth()->id())->get();
    foreach ($writeLang as $write) {
      $this->langWrite .= $write->language->name;
      if ($writeLang->last() != $write) {
        $this->langWrite .= ', ';
      }
    }

    // user spoken language
    $spokenLang = UserCanSpeak::with('language')->where('user_id', auth()->id())->get();
    foreach ($spokenLang as $spoken) {
      $this->langSpoken .= $spoken->language->name;
      if ($spokenLang->last() != $spoken) {
        $this->langSpoken .= ', ';
      }
    }

    // physical challenge
    $userPhysicalList = UserPhysicalChallenge::with('physicalChallenge')->where('user_id', auth()->id())->get();
    foreach ($userPhysicalList as $challenge) {
      $this->physical .= $challenge->physicalChallenge->name;
      if ($userPhysicalList->last() != $challenge) {
        $this->physical .= ', ';
      }
    }
  }

  public function render()
  {
    return view('livewire.web.auth.employee-detail');
  }
}
