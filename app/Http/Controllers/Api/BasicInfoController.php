<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Address;
use App\Models\BasicInfo;
use App\Models\NcoDetail;
use App\Models\OnGoingApplication;
use App\Models\UserNco;
use App\Models\UserPhysicalChallenge;
// use BaconQrCode\Encoder\QrCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class BasicInfoController extends Controller
{
    public function createBasicInfo(Request $request)
    {
        $basicInfo = BasicInfo::firstOrNew(
            ['user_id' => $request->user_id],
        );
        $basicInfo->user_id = $request->user_id;
        if ($request->avatar != $basicInfo->avatar) {
            Storage::disk('public')->delete($basicInfo->avatar);
            $file = $this->storeImage('basic_info', $request->avatar);
            $basicInfo->avatar = $file;
        }
        $dateOfBirth = date('Y-m-d', strtotime($request->dob));
        $basicInfo->full_name = $request->full_name;
        $basicInfo->dob = $dateOfBirth;
        $basicInfo->gender = $request->gender;
        $basicInfo->phone_no = $request->phone_no;
        $basicInfo->email = $request->email;
        $basicInfo->parents_name = $request->parents_name;
        $basicInfo->religion_id = $request->religion_id;
        $basicInfo->caste = $request->caste;
        $basicInfo->marital_status = $request->marital_status;
        $basicInfo->aadhar_no = $request->aadhar_no;
        $basicInfo->physically_challenge = $request->physically_challenge == true ? 1 : 0;
        $basicInfo->society = $request->society;
        $basicInfo->percent_complete = 20;
        $basicInfo->ex_servicemen = $request->ex_servicemen == true ? 1 : 0;
        $basicInfo->save();

        if ($request->physically_challenge == true) {
            $physically_challenges = $request->physically_challenges[0];
            $physically_challenges = explode("(", $physically_challenges)[1];
            $physically_challenges = explode(")", $physically_challenges)[0];
            $physically_challenges = explode(",", $physically_challenges);
            for ($i = 0; $i < count($physically_challenges); $i++) {
                $challenged = UserPhysicalChallenge::firstOrNew(
                    ['user_id' => $request->user_id, 'physical_challenge_id' => $physically_challenges[$i]]
                );
                $challenged->user_id = $request->user_id;
                $challenged->physical_challenge_id = $physically_challenges[$i];
                $challenged->save();
            }
        }

        return response()->json(['success' => 'Basic Info Saved']);
    }

    public function storeImage($path, $base64Image)
    {
        $image_64 = $base64Image;
        $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];
        $image = substr($image_64, strpos($image_64, ',') + 1);
        $imageName = Str::random(30) . date('YmdHis') . '.' . $extension;
        $pathUrl = $path . '/' . $imageName;
        $filePath = Storage::disk('public')->put($pathUrl, base64_decode($image), 'public');
        return $pathUrl;
    }

    public function getRegisterBasicInfo(Request $request)
    {
        $basicInfo = BasicInfo::where('user_id', $request->user_id)->where('status', 'Pending')->latest('updated_at')->with('religion')->with('user')->first();

        //qr-generate

//        $image = QrCode::format('svg')
//            ->generate(route('qr-code', [
//                $basicInfo->phone_no,
//                $basicInfo->employment_no,
//            ]));
//        $path = "images/qr/$basicInfo->employment_no.svg";
//        $basicInfo->qr = $path;
//        Storage::disk('public')->put($path, $image);
//
//        $basicInfo->save();
        //qr-generate

        $address = Address::where('user_id', $request->user_id)
            ->with(['district'])
            ->first();
//        $nco = UserNco::where('user_id', $request->user_id)->first();
//        $ncoCode = NcoDetail::where('id', $nco->nco_code_display)->first();
//        $physically_challenges = UserPhysicalChallenge::where('user_id', $request->user_id)->with('physicalChallenge')->get();
        if ($basicInfo == null) {
            return response()->noContent();
        }
        return response()->json([
            'basicInfo' => $basicInfo, // 'nco' => $ncoCode,
            'address' => $address,
        ]);
    }
    public function getBasicInfo(Request $request)
    {
        $basicInfo = BasicInfo::where('user_id', $request->user_id)->where('status', 'Approved')->latest('updated_at')->with('religion')->with('user')->first();

        //qr-generate

        $image = QrCode::format('svg')
            ->generate(route('qr-code', [
                $basicInfo->phone_no,
                $basicInfo->employment_no,
            ]));
        $path = "images/qr/$basicInfo->employment_no.svg";
        $basicInfo->qr = $path;
        Storage::disk('public')->put($path, $image);

        $basicInfo->save();
        //qr-generate

        $address = Address::where('user_id', $request->user_id)
            ->with(['district'])
            ->first();
        $nco = UserNco::where('user_id', $request->user_id)->first();
        $ncoCode = NcoDetail::where('id', $nco->nco_code_display)->first();
        $physically_challenges = UserPhysicalChallenge::where('user_id', $request->user_id)->with('physicalChallenge')->get();
        if ($basicInfo == null) {
            return response()->noContent();
        }
        return response()->json([
            'basicInfo' => $basicInfo, // 'nco' => $ncoCode,
            'address' => $address,
        ]);
    }

    public function getUsetDetails(Request $request)
    {
        $userDetails = User::where('id', $request->user_id)->first();

        return response()->json($userDetails);
    }

    public function getUserNco(Request $request)
    {
        $nco = UserNco::where('user_id', $request->user_id)->first();

        $ncoCode = NcoDetail::where('id', $nco->nco_code_display)->first();
        info($ncoCode);
        return response()->json(['user_nco' => $ncoCode]);
    }
    public function getPercentCompleted(Request $request)
    {
        $percentage = BasicInfo::where('user_id', $request->user_id)->get('percent_complete')->first();
        return response()->json($percentage);
    }
    public function getCardStatus(Request $request)
    {
        $status = BasicInfo::where('user_id', $request->user_id)->get('status')->first();
        $cardValidTill = BasicInfo::where('user_id', $request->user_id)->get('card_valid_till')->first();
        $canEdit = BasicInfo::where('user_id', $request->user_id)->get('canEdit')->first();
        return response()->json(['status' => $status == null ? 'Pending' : $status, 'cardValidity' => $cardValidTill == null ? 0 : $cardValidTill, 'canEdit' => $canEdit == null ? 1 : $canEdit]);
        //    return response()->json($status==null?0:$status,$cardValidTill==null?'null':$cardValidTill);
    }
    public function checkCanEdit(Request $request)
    {
        $canEdit = BasicInfo::where('user_id', $request->user_id)->get('canEdit')->first();
        return response()->json($canEdit);
    }

    public function checkOnGoing(Request $request)
    {
        $onGoing = OnGoingApplication::query()->where('user_id', $request->user_id)->get();
        return response()->json(['data' => $onGoing]);
    }
}
