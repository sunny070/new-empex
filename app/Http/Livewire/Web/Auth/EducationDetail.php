<?php

namespace App\Http\Livewire\Web\Auth;

use App\Models\BasicInfo;
use App\Models\EducationQualification;
use App\Models\MajorCore;
use App\Models\Qualification;
use App\Models\Subject;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class EducationDetail extends Component
{
    use WithFileUploads;

    public $qualifications;
    public $streams;
    public $cores;
    public $employeeQualifications = [];
    public $hasCertificate = [
        0 => null
    ];

    public $customSubject = [
        0 => false
    ];

    public $customCore = [
        0 => false
    ];

    protected $listeners = [
        'updateSubject', 'updateCore', 'checkCore'
    ];

    public function updateSubject($index, $id)
    {
        if ($id !== '') {
            $this->employeeQualifications[$index]['streams'] = Subject::where('qualification_id', $id)->get();
        } else {
            $this->employeeQualifications[$index]['streams'] = [];
        }
        $this->employeeQualifications[$index]['subject_id'] = null;
        $this->employeeQualifications[$index]['core_id'] = null;
        $this->employeeQualifications[$index]['cores'] = [];
        $this->customSubject[$index] = false;
        $this->customCore[$index] = false;
    }

    public function updateCore($index, $id)
    {
        if ($id == 'other') {
            $this->customSubject[$index] = true;
        } else {
            $this->customSubject[$index] = false;
            if ($id !== '') {
                $this->employeeQualifications[$index]['cores'] = MajorCore::where('subject_id', $id)->get();
            } else {
                $this->employeeQualifications[$index]['cores'] = [];
            }
            $this->employeeQualifications[$index]['core_id'] = null;
        }
        $this->customCore[$index] = false;
    }

    public function checkCore($index, $id)
    {
        if ($id == 'other') {
            $this->customCore[$index] = true;
        } else {
            $this->customCore[$index] = false;
        }
    }

    public function addMoreQualification($index)
    {
        $this->hasCertificate[$index] = null;
        $this->customSubject[$index] = false;
        $this->customCore[$index] = false;
        $this->employeeQualifications[] = ['id' => null, 'qualification_id' => null, 'subject_id' => null, 'core_id' => null, 'school' => null, 'division' => null, 'year' => null, 'duration' => null, 'certificate' => null, 'streams' => [], 'cores' => [], 'custom_subject' => null, 'custom_core' => null];
    }

    public function removeQualification($id = null)
    {
        if (!is_null($id)) {
            EducationQualification::findOrFail($id)->delete();
        }
        unset($this->hasCertificate[array_key_last($this->hasCertificate)]);
        unset($this->customSubject[array_key_last($this->customSubject)]);
        unset($this->customCore[array_key_last($this->customCore)]);
        unset($this->employeeQualifications[array_key_last($this->employeeQualifications)]);
        $this->employeeQualifications = array_values($this->employeeQualifications);
    }

    public function removeCertificate($index)
    {
        $edu = EducationQualification::where('user_id', auth()->id())->where('certificate', $this->employeeQualifications[$index]['certificate'])->first();
        $edu->certificate = null;
        $edu->save();
        Storage::disk('public')->delete($this->employeeQualifications[$index]['certificate']);
        $this->employeeQualifications[$index]['certificate'] = null;
        $this->hasCertificate[$index] =  null;
    }

    public function saveAndNext()
    {
        // Log::info('request'.$this->employeeQualifications);
        $this->validate([
            'employeeQualifications.*.qualification_id' => 'required',
            //added by rj
            // 'employeeQualifications.*.' => 'required',
            //added by rj
            'employeeQualifications.*.school' => 'required',
            'employeeQualifications.*.division' => 'required',
            'employeeQualifications.*.year' => 'required',
            'employeeQualifications.*.duration' => 'required',
            'employeeQualifications.*.certificate' => 'required|max:2048',
            // 'employeeQualifications.*.certificate' => 'employeeQualifications.*.certificate' ? 'required|max:2048' : 'mimes:jpeg,bmp,png,gif,svg,pdf,required|max:2048',
            'employeeQualifications.*.custom_subject' => 'required_if:employeeQualifications.*.subject_id,other',
            'employeeQualifications.*.custom_core' => 'required_if:employeeQualifications.*.core_id,other',
        ]);



        $mainCertificates = EducationQualification::where('user_id', auth()->id())->get()->pluck('certificate');

        EducationQualification::where('user_id', auth()->id())->delete();
        // Log::info('each');
        foreach ($this->employeeQualifications as $index => $quali) {
            $userQuali = new EducationQualification;
            if (count($mainCertificates) > 0) {
                // Log::info('quali cert' . $quali['certificate']);
                // Log::info('main cert' . $mainCertificates[$index]);
                // Log::info('count' . count($mainCertificates));
                // Log::info('index ' . $index);
                //added by rj
                if ($index < count($mainCertificates)) { //added by rj
                    // Log::info('inside < :' . $index);

                    if ($quali['certificate'] == $mainCertificates[$index]) {
                        Log::info('inside == < :' . $index);

                        $userQuali->certificate = $mainCertificates[$index];
                    } else {
                        Log::info('inside == else :' . $index);

                        $userCertificate = $quali['certificate']->storePublicly('certificate', 'public');
                        $userQuali->certificate = $userCertificate;
                    }
                    //added by rj

                    //added by rj
                } else {
                    // Log::info('inside < else :' . $index);

                    $userCertificate = $quali['certificate']->storePublicly('certificate', 'public');
                    $userQuali->certificate = $userCertificate;
                }
                //added by rj
            } else {
                // Log::info('if not :' . $index);
                $userCertificate = $quali['certificate']->storePublicly('certificate', 'public');
                $userQuali->certificate = $userCertificate;
            }

            $userQuali->user_id = auth()->id();
            $userQuali->qualification_id = $quali['qualification_id'];
            $userQuali->school = $quali['school'];

            if ($quali['subject_id'] !== 'other') {
                $userQuali->subject_id = $quali['subject_id'];
            } else {
                $userQuali->custom_subject = $quali['custom_subject'];
                $userQuali->custom_major_core = $quali['custom_core'];
            }

            if ($quali['core_id'] !== 'other') {
                $userQuali->major_core_id = $quali['core_id'];
            } else {
                $userQuali->custom_major_core = $quali['custom_core'];
            }

            $userQuali->year_of_passing = $quali['year'];
            $userQuali->division = $quali['division'];
            $userQuali->course_duration = $quali['duration'];
            $userQuali->save();
        }

        $info = BasicInfo::where('user_id', auth()->id())->latest('updated_at')->first();
        $info->percent_complete = '60';
        $info->save();

        $this->emit('stepIncrement');
    }

    public function back()
    {
        $this->emit('stepDecrement');
    }

    public function mount()
    {
        $this->qualifications = Qualification::get();
        $this->streams = collect();
        $this->cores = collect();

        $userEducations = EducationQualification::with('qualification', 'subject', 'majorCore')->where('user_id', auth()->id())->get();
        if (count($userEducations) > 0) {
            foreach ($userEducations as $index => $edu) {
                $this->employeeQualifications[] = ['id' => $edu->id, 'qualification_id' => $edu->qualification_id, 'subject_id' => $edu->subject_id, 'core_id' => $edu->major_core_id, 'school' => $edu->school, 'division' => $edu->division, 'year' => $edu->year_of_passing, 'duration' => $edu->course_duration, 'certificate' => $edu->certificate, 'streams' => [], 'cores' => [], 'custom_subject' => $edu->custom_subject, 'custom_core' => $edu->custom_major_core];

                if ($edu->qualification_id !== null) {
                    $this->employeeQualifications[$index]['streams'] = Subject::where('qualification_id', $edu->qualification_id)->get();
                }

                if ($edu->subject_id !== null) {
                    $this->employeeQualifications[$index]['cores'] = MajorCore::where('subject_id', $edu->subject_id)->get();
                }
                $this->hasCertificate[$index] = $this->employeeQualifications[$index]['certificate'];

                if ($edu->custom_subject !== null) {
                    $this->customSubject[$index] = true;
                    $this->employeeQualifications[$index]['subject_id'] = 'other';
                }

                if ($edu->custom_major_core !== null) {
                    $this->customCore[$index] = true;
                    $this->employeeQualifications[$index]['core_id'] = 'other';
                }
            }
        } else {
            $this->employeeQualifications = [
                ['id' => null, 'qualification_id' => null, 'subject_id' => null, 'core_id' => null, 'school' => null, 'division' => null, 'year' => null, 'duration' => null, 'certificate' => null, 'streams' => [], 'cores' => [], 'custom_subject' => null, 'custom_core' => null]
            ];
        }
    }

    public function hydrate()
    {
        $this->emit('select2AutoInit');
    }

    public function render()
    {
        return view('livewire.web.auth.education-detail');
    }
}
