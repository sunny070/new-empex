<?php

namespace App\Http\Livewire\District\Reports;

use App\Exports\UserListExport;
use App\Models\AdminDistrict;
use App\Models\BasicInfo;
use App\Models\District;
use App\Models\EducationQualification;
use App\Models\MajorCore;
use App\Models\Qualification;
use App\Models\Subject;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class RegisteredUser extends Component
{
  public $qualifications;
  public $qualificationId;
  public $subjects;
  public $subjectId;
  public $cores;
  public $coreId;

  public $reports;

  public $districts;
  public $district = 'All';
  public $buttonEnable = true;
  public $generated = false;
  public $districtName;

  public $selectedQualification;
  public $selectedSubject;
  public $selectedCore;

  public function generateReport()
  {
    $educationQualifications = EducationQualification::when($this->qualificationId != null, function ($query) {
      $query->where('qualification_id', $this->qualificationId);
    })
      ->when($this->subjectId != null, function ($query) {
        $query->where('subject_id', $this->subjectId);
      })
      ->when($this->coreId != null, function ($query) {
        $query->where('major_core_id', $this->coreId);
      })
      ->get()
      ->pluck('user_id');

    $this->reports = BasicInfo::whereIn('user_id', $educationQualifications)
      ->when($this->district != 'All', function ($q) {
        return $q->where('district_id', $this->district);
      })
      ->where('status', 'Approved')
      ->where('card_valid_till', '>=', now())
      ->where('is_archive', 0)
      ->with([
        'permanent_address' => fn ($q) => $q->with('state', 'district'),
      ])
      ->with('district')
      ->get();

    $this->districtName = $this->district != 'All' ? strtoupper(District::where('id', $this->district)->value('name')) : strtoupper($this->district);

    $this->generated = true;
    $this->buttonEnable = false;
  }

  public function downloadReport()
  {
    return Excel::download(new UserListExport(
      $this->reports,
      $this->selectedQualification,
      $this->selectedSubject,
      $this->selectedCore,
      $this->districtName,
    ), "$this->selectedQualification.xlsx");
  }

  public function mount()
  {
    // $this->districts = District::orderBy('name', 'ASC')->get();
    $authDistricts = AdminDistrict::where('admin_id', auth()->guard('admin')->id())->pluck('district_id')->toArray();
    $this->districts = District::orderBy('name', 'ASC')->whereIn('id',$authDistricts)->get();

    $this->qualifications = Qualification::get();
    if (count($this->qualifications) > 0) {
      $this->qualificationId = $this->qualifications[0]->id;
      $this->selectedQualification = $this->qualifications[0]->name;
    } else {
      $this->qualificationId = null;
      $this->selectedQualification = null;
    }
    $this->subjects = collect();
    $this->cores = collect();
    $this->reports = collect();
  }

  public function updatedQualificationId()
  {
    $this->subjects = Subject::where('qualification_id', $this->qualificationId)->orderBy('name', 'ASC')->get();
    if (count($this->subjects) > 0) {
      $this->subjectId = $this->subjects[0]->id;
      $this->selectedSubject = $this->subjects[0]->name;
    } else {
      $this->subjectId = null;
      $this->selectedSubject = null;
    }
    $this->cores = collect();
    $this->selectedQualification = Qualification::where('id', $this->qualificationId)->value('name');
    $this->updatedCondition();
  }

  public function updatedSubjectId()
  {
    $this->cores = MajorCore::where('subject_id', $this->subjectId)->orderBy('name', 'ASC')->get();
    if (count($this->cores) > 0) {
      $this->coreId = $this->cores[0]->id;
      $this->selectedCore = $this->cores[0]->name;
    } else {
      $this->coreId = null;
      $this->selectedCore = null;
    }
    $this->selectedSubject = Subject::where('id', $this->subjectId)->value('name');
    $this->updatedCondition();
  }

  public function updatedCoreId()
  {
    $this->selectedCore = MajorCore::where('id', $this->coreId)->value('name');
    $this->updatedCondition();
  }

  public function updatedCondition()
  {
    $this->generated = false;
    $this->buttonEnable = true;
  }

  public function updatedDistrict()
  {
    $this->updatedCondition();
  }

  public function render()
  {
    return view('livewire.district.reports.registered-user');
  }
}
