<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\SendStatusSms;
use App\Models\BasicInfo;
use App\Models\ChangeBasicInfo;
use App\Models\ChangeUserCanRead;
use App\Models\ChangeUserCanSpeak;
use App\Models\ChangeUserCanWrite;
use App\Models\ChangeUserPhysicalChallenge;
use App\Models\OnGoingApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class BasicInfoChangeController extends Controller
{
    public function checkChangeBasicInfo($id)
    {
        $changeCheck = ChangeBasicInfo::where('user_id', $id)->first();
        info($changeCheck);
        if ($changeCheck != null) {
            return response()->json(200);
        } else {
            return response()->noContent();
        }
    }
    public function updateBasicInfo(Request $request)
    {
        info($request->$request);
        $basicInfo = new ChangeBasicInfo;
        $checkBasicInfo = BasicInfo::where('user_id', $request->user_id)->first();
        
        $basicInfo->user_id = $request->user_id;
        if ($request->avatar != $checkBasicInfo->avatar) {
            Storage::disk('public')->delete($basicInfo->avatar);
            $file = $this->storeImage('basic_info', $request->avatar);
            $basicInfo->avatar = $file;
        }
        $dateOfBirth = date('Y-m-d', strtotime($request->dob));
        $basicInfo->full_name = $request->full_name;
        $basicInfo->dob = $dateOfBirth;
        $basicInfo->email = $request->email;
        $basicInfo->gender = $request->gender;
        $basicInfo->phone_no = $request->phone_no;
        $basicInfo->parents_name = $request->parents_name;
        $basicInfo->religion_id = $request->religion_id;
        $basicInfo->caste = $request->caste;
        $basicInfo->marital_status = $request->marital_status;
        $basicInfo->aadhar_no = $request->aadhar_no;
        $basicInfo->physically_challenge = $request->physically_challenge == true ? 1 : 0;
        $basicInfo->society = $request->society;
        $basicInfo->user_district_id = BasicInfo::where('user_id', $request->user_id)->value('district_id');
        $basicInfo->save();
        if($basicInfo->physically_challenge==1){
            $physically_challenges = $request->physically_challenges[0];
            if (strlen($physically_challenges) != 2) {
                $physically_challenges = explode("(", $physically_challenges)[1];
                $physically_challenges = explode(")", $physically_challenges)[0];
                $physically_challenges = explode(",", $physically_challenges);
                for ($i = 0; $i < count($physically_challenges); $i++) {
                    $challenged = ChangeUserPhysicalChallenge::firstOrNew(
                        ['user_id' => $request->user_id, 'physical_challenge_id' => $physically_challenges[$i]]
                    );
                    $challenged->user_id = $request->user_id;
                    $challenged->physical_challenge_id = $physically_challenges[$i];
                    $challenged->save();
                }
            }
        }
       
        // $onGoing = new OnGoingApplication;
        // $onGoing->user_id = $request->user_id;
        // $onGoing->type = 'Change Request - Basic Info';
        // $onGoing->model_name = 'ChangeBasicInfo';
        // $onGoing->requested_id = $basicInfo->id;
        // $onGoing->status = 'Pending';
        // $onGoing->color = '#ff7e0e';
        // $onGoing->bg = '#fff5ef';
        // $onGoing->save();

        // SendStatusSms::dispatch($basicInfo->phone_no, 'change information', 'received')->delay(now()->addSeconds(5));

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

    public function changeLanguages(Request $request)
    {
        $canSpeak = $request->can_speak;
        $canRead = $request->can_read;
        $canWrite = $request->can_write;

        if (strlen($canSpeak) != 2) {
            $canSpeak = explode("[(", $canSpeak)[1];
            $canSpeak = explode(")]", $canSpeak)[0];
            $canSpeak = explode(",", $canSpeak);
            if (ChangeUserCanSpeak::where('user_id', $request->user_id)->count() != 0) {
                ChangeUserCanSpeak::where('user_id', $request->user_id)->delete();
            }
            foreach ($canSpeak as $speaks) {
                $userCanSpeak = new ChangeUserCanSpeak();
                $userCanSpeak->user_id = $request->user_id;
                $userCanSpeak->language_id = $speaks;
                $userCanSpeak->save();
            }
        }
        if (strlen($canRead) != 2) {
            $canRead = explode("[(", $canRead)[1];
            $canRead = explode(")]", $canRead)[0];
            $canRead = explode(",", $canRead);
            if (ChangeUserCanRead::where('user_id', $request->user_id)->count() != 0) {
                ChangeUserCanRead::where('user_id', $request->user_id)->delete();
            }
            foreach ($canRead as $read) {
                $userCanRead = new ChangeUserCanRead();
                $userCanRead->user_id = $request->user_id;
                $userCanRead->language_id = $read;
                $userCanRead->save();
            }
        }
        if (strlen($canWrite) != 2) {
            $canWrite = explode("[(", $canWrite)[1];
            $canWrite = explode(")]", $canWrite)[0];
            $canWrite = explode(",", $canWrite);
            if (ChangeUserCanWrite::where('user_id', $request->user_id)->count() != 0) {
                ChangeUserCanWrite::where('user_id', $request->user_id)->delete();
            }
            foreach ($canWrite as $write) {
                $userCanWrite = new ChangeUserCanWrite();
                $userCanWrite->user_id = $request->user_id;
                $userCanWrite->language_id = $write;
                $userCanWrite->save();
            }
        }
        return response()->json(['success' => 'User languages added']);
    }
}
