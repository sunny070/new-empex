<?php

namespace App\Http\Livewire\Employer;

use App\Jobs\SendJobNotification;
use App\Jobs\SendOtp;
use App\Models\Admin;
use App\Models\BasicInfo;
use App\Models\JobFile;
use App\Models\JobNco;
use App\Models\JobPost;
use App\Models\NcoFamily;
use App\Models\UserNco;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class JobCreate extends Component
{
    use WithFileUploads;

    public $jobId = null;
    public $title, $description, $no_of_post, $due_date;
    public $files = [];
    public $nco; // store nco family id
    public $ncoOccupation;
    public $attachments = [];
    public $jobAttachments = [];

    public $category, $type, $sector, $organization, $department;

    public $confirmOtp = false;
    public $otp, $otpSent;

    public function addMoreAttachment()
    {
        $this->attachments[] = ['file' => null];
    }

    public function removeAttachment($index)
    {
        unset($this->attachments[$index]);
        $this->attachments = array_values($this->attachments);
    }

    public function deleteAttachment($fileId, $index)
    {
        $file = JobFile::where('id', $fileId)->first();
        Storage::disk('public')->delete($file->file);
        $file->delete();
        unset($this->jobAttachments[$index]);
        $this->jobAttachments = array_values($this->jobAttachments);
    }

    public function cancel()
    {
        return redirect(route('employer.dashboard'));
    }

    function formatBytes($size, $precision = 1)
    {
        $base = log($size, 1024);
        $suffixes = array('B', 'Kb', 'Mb', 'Gb', 'Tb');
        return round(pow(1024, $base - floor($base)), $precision) . ' ' . $suffixes[floor($base)];
    }

    public function saveJob()
    {
        $this->validate([
            'title' => 'required',
            'files.*' => 'nullable|max:2048',
            'description' => 'required',
            'no_of_post' => 'required',
            'due_date' => 'required',
            'nco' => 'required',
        ]);

        if ($this->category != 3 || $this->jobId != null) {
            $this->jobPost();
        }

        // for govt department, otp is needed for posting jobs
        if ($this->confirmOtp == false) {
            $this->confirmOtp = true;
            // $this->otpSent = '1234';
            $this->otpSent = env('APP_ENV') == 'local' ?  0000 : rand(1000, 9999);
            env('APP_ENV') != 'local' && SendOtp::dispatch(auth()->guard('admin')->user()->contact, $this->otpSent)->delay(now()->addSeconds(5));
        } else {
            $this->validate([
                'otp' => 'required|digits:4'
            ]);

            if ($this->otpSent == $this->otp) {
                $this->jobPost();
            } else {
                session()->flash('otpError', 'Please enter valid OTP');
            }
        }
    }

    public function jobPost()
    {
        if ($this->jobId !== null) {
            $job = JobPost::findOrFail($this->jobId);
        } else {
            $job = new JobPost;
        }

        $job->title = $this->title;
        $job->category_id = $this->category;
        $job->type_id = $this->type;
        $job->sector_id = $this->sector;
        $job->organization_name = $this->organization;

        if ($this->category == 3) {
            $job->department_id = $this->department;
            $job->published = 1;
        }

        // $job->slug = Str::slug($this->title);
        $job->description = $this->description;
        $job->no_of_post = $this->no_of_post;
        $job->due_date_of_submission = $this->due_date;
        $job->created_by = auth()->guard('admin')->id();
        // if ($this->jobId)
        //     $job->slug = Str::slug($this->title);

        $job->save();

        foreach ($this->attachments as $file) {
            if ($file['file'] !== null) {
                $jobFile = new JobFile();
                $jobFile->job_post_id = $job->id;
                $jobFile->file = $file['file']->storePublicly('job_attachments', 'public');
                $jobFile->file_name = $file['file']->getClientOriginalName();
                $jobFile->file_size = $this->formatBytes($file['file']->getSize());
                $jobFile->save();
            }
        }

        JobNco::where('job_post_id', $job->id)->delete();
        foreach ($this->nco as $nco) {
            $jobNco = new JobNco();
            $jobNco->job_post_id = $job->id;
            $jobNco->nco_family_id = $nco;
            $jobNco->save();
        }

        // if ($this->jobId == null) {
        //     $userFamilyNcoList = UserNco::whereIn('family_id', $this->nco)->with('user')->get();

        //     $ncoUserToNotify = [];
        //     foreach ($userFamilyNcoList as $unco) {
        //         if (!array_key_exists($unco->user_id, $ncoUserToNotify)) {
        //             $ncoUserToNotify[$unco->user_id] = $unco->user->mobile_no;
        //         }
        //     }

        //     if (count($ncoUserToNotify) > 0) {
        //         SendJobNotification::dispatch(array_values($ncoUserToNotify), URL::to('/') . '/jobs/' . $job->slug)->delay(5);
        //     }
        // }

        return redirect(route('employer.dashboard'));
    }

    public function mount($id)
    {
        $admin = Admin::where('id', auth()->guard('admin')->id())
            ->with([
                'organization' => function ($org) {
                    return $org->with('department');
                },
            ])
            ->first();

        $this->category = $admin->category_id;
        $this->type = $admin->organization->type_id;
        $this->sector = $admin->organization->sector_id;
        if ($admin->category_id == 3) {
            $this->organization = $admin->organization->department->name;
            $this->department = $admin->organization->department_id;
        } else {
            $this->organization = $admin->organization->name;
        }


        if ($id !== null) {
            $this->jobId = $id;
            $job = JobPost::where('id', $id)->first();
            $this->title = $job->title;
            $this->description = $job->description;
            $this->no_of_post = $job->no_of_post;
            $this->due_date = $job->due_date_of_submission;

            $jobNco = JobNco::where('job_post_id', $id)->get();
            foreach ($jobNco as $jnco) {
                $this->nco[] = $jnco->nco_family_id;
            }

            $attachments = JobFile::where('job_post_id', $id)->get();
            foreach ($attachments as $file) {
                $this->jobAttachments[] = $file;
            }
        }

        if (count($this->jobAttachments) == 0) {
            $this->attachments = [['file' => null]];
        }

        $this->ncoOccupation = NcoFamily::orderBy('name', 'ASC')->get();
    }

    public function hydrate()
    {
        $this->emit('select2AutoInit');
    }

    public function render()
    {
        return view('livewire.employer.job-create');
    }
}
