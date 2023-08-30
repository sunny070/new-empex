<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\BasicInfo;
use App\Models\NcoDetail;
use App\Models\UserNco;
use Carbon\Carbon;
use Illuminate\Http\Request;

class QrController extends Controller
{
    public function index($phone, $empNo)
    {
        $info = BasicInfo::where('phone_no', $phone)->where('employment_no', $empNo)->with('user')->firstOrFail();

        $district = Address::with('district:id,name')->where('user_id', $info->user_id)->where('type', 'permanent')->first();

        $validDate = Carbon::parse($info->card_valid_till);

        $authPreferNcoCode = UserNco::where('user_id', $info->user_id)->where('nco_code_display', '!=', null)->value('nco_code_display');
        $ncoCodeToDisplay = NcoDetail::where('id', $authPreferNcoCode)->value('code');

        $result = now()->diffInDays($validDate, false);

        $s = '';
        if ($result < 0) {
            $daysLeft = '<span class="text-empex-red">Expired</span>';
        } else {
            if ($result >= 10) {
                $s = 's';
            }
            $daysLeft = '<span>' . $result . ' Day' . $s . '</span>';
        }

        return view('web.qr-scan', compact('info', 'district', 'daysLeft', 'ncoCodeToDisplay'));
    }
}
