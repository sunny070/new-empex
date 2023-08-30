<?php

namespace App\Http\Livewire\Admin\Reports;

use App\Exports\SponsorshipExport;
use App\Mail\SponsoredNotificationEmail;
use App\Models\AdminDistrict;
use App\Models\BasicInfo;
use App\Models\District;
use App\Models\EducationQualification;
use App\Models\MajorCore;
use App\Models\Qualification;
use App\Models\SponsoredNotification;
use App\Models\Sponsorship as ModelsSponsorship;
use App\Models\SponsorshipMajorCore;
use App\Models\SponsorshipQualification;
use App\Models\SponsorshipSubject;
use App\Models\SponsorshipUser;
use App\Models\Subject;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class Sponsorship extends Component
{
    use WithFileUploads;

    public $qualifications;
    public $qualificationIds = [];
    public $subjects;
    public $subjectIds = [];
    public $cores;
    public $coreIds = [];
    public $qualifiedUsers = [];
    public $female = [];

    public $generated = false;
    public $buttonEnable = false;
    public $district = 'All';
    public $districts;

    public $category;
    public $male_per_post;
    public $female_per_post;
    public $lower_age;
    public $upper_age;
    public $maxPerPost = '20';

    public $lowerAgeYmd;
    public $upperAgeYmd;

    public $sponsorshipName;
    public $employerName;
    public $address;
    public $sponsorshipFile;
    public $totalSponsored;
    public $shouldDownload = false;

    public function updatedCategory()
    {
        $this->updatedCondition();
    }

    public function updatedDistrict()
    {
        $this->updatedCondition();
    }

    public function updatedLowerAge()
    {
        if ($this->lower_age != null) {
            $year = date('Y', strtotime(now()));
            $year = $year - $this->lower_age;
            $month = date('m', strtotime(now()));
            $date = date('d', strtotime(now()));
            $this->lowerAgeYmd = date('Y-m-d', strtotime($year . '-' . $month . '-' . $date));
        } else {
            $this->lowerAgeYmd = null;
        }

        $this->updatedCondition();
    }

    public function updatedUpperAge()
    {
        if ($this->upper_age != null) {
            $year = date('Y', strtotime(now()));
            $year = $year - $this->upper_age;
            $month = date('m', strtotime(now()));
            $date = date('d', strtotime(now()));
            $this->upperAgeYmd = date('Y-m-d', strtotime($year . '-' . $month . '-' . $date));
        } else {
            $this->upperAgeYmd = null;
        }

        $this->updatedCondition();
    }

    public function updatedMalePerPost()
    {
        if ($this->male_per_post != null && (int)$this->male_per_post <= 20) {
            if ($this->male_per_post <= $this->maxPerPost) {
                $this->female_per_post = $this->maxPerPost - $this->male_per_post;
            }
        } elseif ($this->male_per_post != null && (int)$this->male_per_post > 20) {
            $this->male_per_post = '20';
            $this->female_per_post = null;
        } else {
            $this->male_per_post = null;
            $this->female_per_post = null;
        }

        $this->updatedCondition();
    }

    public function updatedFemalePerPost()
    {
        if ($this->female_per_post != null && (int)$this->female_per_post <= 20) {
            if ($this->female_per_post <= $this->maxPerPost) {
                $this->male_per_post = $this->maxPerPost - $this->female_per_post;
            }
        } elseif ($this->female_per_post != null && (int)$this->female_per_post > 20) {
            $this->female_per_post = '20';
            $this->male_per_post = null;
        } else {
            $this->female_per_post = null;
            $this->male_per_post = null;
        }

        $this->updatedCondition();
    }

    public function updatedQualificationIds()
    {
        if (count($this->qualificationIds) > 0) {
            $this->subjects = Subject::whereIn('qualification_id', $this->qualificationIds)->orderBy('name', 'ASC')->get();
        } else {
            $this->subjects = collect();
            $this->cores = collect();
            $this->subjectIds = [];
            $this->coreIds = [];
        }

        $this->updatedCondition();
    }

    public function updatedSubjectIds()
    {
        if (count($this->subjectIds) > 0) {
            $this->cores = MajorCore::whereIn('subject_id', $this->subjectIds)->orderBy('name', 'ASC')->get();
        } else {
            $this->cores = collect();
            $this->coreIds = [];
        }

        $this->updatedCondition();
    }

    public function updatedCoreIds()
    {
        $this->updatedCondition();
    }

    public function updatedCondition()
    {
        if (count($this->qualificationIds) > 0) {
            $this->buttonEnable = true;
        } else {
            $this->buttonEnable = false;
        }
        $this->generated = false;
    }

    public function generateSponsorship()
    {
        $this->qualifiedUsers = [];


        // dd([
        //     'male_per_post' => $this->male_per_post,
        //     'female_per_post' => $this->female_per_post,
        // ]);



        $qualifiedUserIds = EducationQualification::whereIn('qualification_id', $this->qualificationIds)
            ->when(count($this->subjectIds) > 0, fn ($q) => $q->whereIn('subject_id', $this->subjectIds))
            ->when(count($this->coreIds) > 0, fn ($q) => $q->whereIn('major_core_id', $this->coreIds))
            ->groupBy('user_id')
            ->pluck('user_id')
            ->toArray();

        // dd($qualifiedUserIds);
        // dd(['lowerage' => $this->lowerAgeYmd, 'upper' => $this->upperAgeYmd]);

        if ($this->male_per_post != null) {
            $this->qualifiedUsers = BasicInfo::whereIn('user_id', $qualifiedUserIds)
                ->where('status', 'Approved')
                ->where('is_archive', 0)
                ->where('card_valid_till', '>=', now())
                ->where('gender', 'Male')
                ->when($this->district != 'All', fn ($q) => $q->where('district_id', $this->district))
                ->when($this->category != null && $this->category != 'ExServicemen', fn ($q) => $q->where('caste', $this->category))
                ->when($this->category != null && $this->category == 'ExServicemen', fn ($q) => $q->where('ex_servicemen', 1))
                // valpuia
                // ->when($this->lower_age != null, fn ($q) => $q->where('dob', '<=', $this->lowerAgeYmd))
                // ->when($this->upper_age != null, fn ($q) => $q->where('dob', '>=', $this->upperAgeYmd))
                // rja
                ->when($this->lower_age != null, fn ($q) => $q->where('dob', '>=', $this->lowerAgeYmd))
                ->when($this->upper_age != null, fn ($q) => $q->where('dob', '<=', $this->upperAgeYmd))
                ->with([
                    'permanent_address' => fn ($q) => $q->with('state', 'district'),
                    'education' => fn ($q) => $q->with('qualification', 'subject', 'majorCore'),
                ])
                ->take((int)$this->male_per_post)
                ->orderBy('sponsorship_count', 'ASC')
                ->get()
                ->toArray();

            // dd($this->qualifiedUsers);

        }

        if ($this->female_per_post != null) {

            $female =  BasicInfo::whereIn('user_id', $qualifiedUserIds)
                ->where('status', 'Approved')
                ->where('is_archive', 0)
                ->where('card_valid_till', '>=', now())
                ->where('gender', 'Female')
                ->when($this->district != 'All', fn ($q) => $q->where('district_id', $this->district))
                ->when($this->category != null && $this->category != 'ExServicemen', fn ($q) => $q->where('caste', $this->category))
                ->when($this->category != null && $this->category == 'ExServicemen', fn ($q) => $q->where('ex_servicemen', 1))
                //valupuia
                // ->when($this->lower_age != null, fn ($q) => $q->where('dob', '<=', $this->lowerAgeYmd))
                // ->when($this->upper_age != null, fn ($q) => $q->where('dob', '>=', $this->upperAgeYmd))
                // rja
                ->when($this->lower_age != null, fn ($q) => $q->where('dob', '>=', $this->lowerAgeYmd))
                ->when($this->upper_age != null, fn ($q) => $q->where('dob', '<=', $this->upperAgeYmd))

                ->with([
                    'permanent_address' => fn ($q) => $q->with('state', 'district'),
                    'education' => fn ($q) => $q->with('qualification', 'subject', 'majorCore'),
                ])
                ->take((int)$this->female_per_post)
                ->orderBy('sponsorship_count', 'ASC')
                ->get()
                ->toArray();
            $this->qualifiedUsers  = [...$this->qualifiedUsers,...$female];
        }
        // dd([$this->qualifiedUsers]);


        // dd([
        //     'male_per_post' => $this->male_per_post,
        //     'female_per_post' => $this->female_per_post,
        //     'female_data' => $female,
        //     'male_data' => $male,
        //     'total_data' => $this->qualifiedUsers,
        // ]);

        if ($this->male_per_post == null && $this->female_per_post == null) {
            $this->qualifiedUsers = BasicInfo::whereIn('user_id', $qualifiedUserIds)
                ->where('status', 'Approved')
                ->where('is_archive', 0)
                ->where('card_valid_till', '>=', now())
                ->when($this->district != 'All', fn ($q) => $q->where('district_id', $this->district))
                ->when($this->category != null && $this->category != 'ExServicemen', fn ($q) => $q->where('caste', $this->category))
                ->when($this->category != null && $this->category == 'ExServicemen', fn ($q) => $q->where('ex_servicemen', 1))
                //valpuia
                // ->when($this->lower_age != null, fn ($q) => $q->where('dob', '<=', $this->lowerAgeYmd))
                // ->when($this->upper_age != null, fn ($q) => $q->where('dob', '>=', $this->upperAgeYmd))
                // rja
                ->when($this->lower_age != null, fn ($q) => $q->where('dob', '>=', $this->lowerAgeYmd))
                ->when($this->upper_age != null, fn ($q) => $q->where('dob', '<=', $this->upperAgeYmd))
                ->with([
                    'permanent_address' => fn ($q) => $q->with('state', 'district'),
                    'education' => fn ($q) => $q->with('qualification', 'subject', 'majorCore'),
                ])
                ->limit(20)
                ->orderBy('sponsorship_count', 'ASC')
                ->get()
                ->toArray();
        }


        $this->generated = true;
        $this->buttonEnable = false;
    }

    public function confirm()
    {
        $this->validate([
            'sponsorshipName' => 'required',
            'employerName' => 'required',
            'address' => 'required',
            'sponsorshipFile' => 'nullable|max:2048',
        ]);

        $filePath = 'excel/' . $this->sponsorshipName . '-' . date('Y-m-d-H-i-s') . '.xlsx';
        Excel::store(new SponsorshipExport(
            $this->qualifiedUsers,
            $this->sponsorshipName,
            $this->employerName,
            $this->address,
            now()->format('d/m/Y')
        ), $filePath, 'public');

        $spon = new ModelsSponsorship();
        $spon->name = $this->sponsorshipName;
        if ($this->sponsorshipFile) {
            $spon->file = $this->sponsorshipFile->storePublicly('sponsorship', 'public');
        }
        $spon->employer_name = $this->employerName;
        $spon->address = $this->address;
        $spon->district = District::where('id', $this->district)->value('name');
        $spon->male_per_post = $this->male_per_post != null ? $this->male_per_post : null;
        $spon->female_per_post = $this->female_per_post != null ? $this->female_per_post : null;
        $spon->min_age = $this->lower_age != null ? $this->lower_age : null;
        $spon->max_age = $this->upper_age != null ? $this->upper_age : null;
        $spon->category = $this->category != null ? $this->category : null;
        $spon->file_path = $filePath;
        $spon->save();

        foreach ($this->qualifiedUsers as $user) {
            $info = BasicInfo::where('user_id', $user['user_id'])->first();
            $info->sponsorship_count += 1;
            $info->save();

            $spUser = new SponsorshipUser();
            $spUser->sponsorship_id = $spon->id;
            $spUser->user_id = $user['user_id'];
            $spUser->save();

            $noti = new SponsoredNotification();
            $noti->user_id = $user['user_id'];
            $noti->content = '
        To, <br><br>' . $user['full_name'] . '<br>' . $user['gender'] == 'Male' ? 's/o' : 'd/o' . ' ' . $user['parents_name'] . '<br>' . ($user['permanent_address']['village'] ?? '') . ', ' . ($user['permanent_address']['district']['name'] ?? '') . ', ' .
                ($user['permanent_address']['state']['name'] ?? '') . '<br>Phone No: ' . $user['phone_no'] . '<br><br>Dear Jobseeker,<br>Your profile has been selected for screening. Please find the details below<br><br>Sponsorship Name: ' . $spon->name . '<br>Employer : ' . $spon?->employer_name . '<br>Address : ' . $spon?->address . '<br><br>You may await further instructions from the ' . $spon->employer_name . '<br><br>Regards,<br><br>Employment Exchange (EmpEx)<br>LESDE, Mizoram.
      ';

            $noti->save();

            Mail::to($user['email'])->later(now()->addMinutes(2), new SponsoredNotificationEmail($user, $spon));
        }

        foreach ($this->qualificationIds as $quali) {
            $spQuali = new SponsorshipQualification();
            $spQuali->sponsorship_id = $spon->id;
            $spQuali->qualification_id = $quali;
            $spQuali->save();
        }

        foreach ($this->subjectIds as $subj) {
            $spSubj = new SponsorshipSubject();
            $spSubj->sponsorship_id = $spon->id;
            $spSubj->subject_id = $subj;
            $spSubj->save();
        }

        foreach ($this->coreIds as $core) {
            $spCore = new SponsorshipMajorCore();
            $spCore->sponsorship_id = $spon->id;
            $spCore->major_core_id = $core;
            $spCore->save();
        }

        return redirect(route('admin.report.sponsorship.list'));
    }

    public function mount()
    {
        if (auth()->guard('admin')->user()->role_id != 1 && auth()->guard('admin')->user()->role_id != 5) {
            abort(401);
        }
        $this->qualifications = Qualification::get();
        $this->subjects = collect();
        $this->cores = collect();


        if (auth()->guard('admin')->user()->role_id == 1)
            $this->districts = District::orderBy('name', 'ASC')->get();
        else {

            $authDistricts = AdminDistrict::where('admin_id', auth()->guard('admin')->id())->pluck('district_id')->toArray();
            $this->districts = District::query()->whereIn('id', $authDistricts)->orderBy('name', 'ASC')->get();
        }



        $this->totalSponsored = ModelsSponsorship::count();
    }

    public function hydrate()
    {
        $this->emit('select2AutoInit');
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.admin.reports.sponsorship');
    }
}
