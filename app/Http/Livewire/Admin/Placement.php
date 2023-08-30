<?php

namespace App\Http\Livewire\Admin;

use App\Jobs\SendJobNotification;
use App\Models\BasicInfo;
use App\Models\Category;
use App\Models\JobFile;
use App\Models\JobNco;
use App\Models\JobPost as ModelsJobPost;
use App\Models\NcoDetail;
use App\Models\NcoFamily;
use App\Models\NcoGroup;
use App\Models\Sector;
use App\Models\Type;
use App\Models\UserNco;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Placement extends Component
{
    use WithFileUploads;

    public $categories;
    public $sectors;
    public $types = [];

    public $category;
    public $type;
    public $sector;
    public $description;
    public $noOfPosts;
    public $dueDate;
    public $file;
    public $title;
    public $organizationName;

    public $attachments = [];
    public $jobAttachments = [];

    public $nco = [];
    public $files = [];

    public $ncoList;

    public $ncoSelectionModal = false;

    public $checkData = [];
    public $checkDataForStore = [];
    public $showNcoDetails = false;
    public $allNcoDetails = [];
    public $ncoOccupation;

    public $jobId;
    public $deleteDialog = false;

    public function updatedCheckData()
    {
        $this->allNcoDetails = [];
        foreach ($this->checkData as $check) {
            $family = NcoFamily::where('id', $check)
                ->with([
                    'group' => function ($group) {
                        return $group->with('division', 'subdivision');
                    }
                ])
                ->first()
                ->toArray();

            $detailsList = NcoDetail::where('nco_family_id', $check)->get()->toArray();
            $detail = [];
            if (count($detailsList) > 0) {
                foreach ($detailsList as $det) {
                    $detail[] = [
                        'id' => $det['id'],
                        'name' => $det['name'],
                        'code' => $det['code']
                    ];
                }
            }
            array_push($this->allNcoDetails, ['detail' => $detail, 'family' => $family, 'group' => $family['nco_group_id'], 'division' => $family['group']['division']['name']]);
        }

        $this->showNcoDetails = true;
    }

    public function mount()
    {
        $this->categories = Category::get();
        $this->sectors = Sector::get();
        $this->ncoOccupation = NcoFamily::orderBy('name', 'ASC')->get();
    }

    public function showNcoSelectionModal()
    {
        $this->ncoSelectionModal = true;
    }

    public function closeDialog()
    {
        $this->ncoSelectionModal = false;
    }

    public function updatedCategory($id)
    {
        if ($id != null) {
            $this->types = Type::where('category_id', $id)->get();
        }
    }

    public function addMoreAttachment()
    {
        $this->attachments[] = ['file' => null];
    }

    public function removeAttachment($index)
    {
        unset($this->attachments[$index]);
        $this->attachments = array_values($this->attachments);
    }

    public function submit()
    {
        $this->validate(
            [
                'title' => 'required',
                'category' => 'required',
                'files.*' => 'nullable|max:2048',
                'type' => 'required',
                'sector' => 'required',
                'description' => 'required',
                'noOfPosts' => 'required',
                'dueDate' => 'required',
                'organizationName' => 'required',
                'nco' => 'required',
            ]
        );

        $jobPost = new ModelsJobPost;

        $jobPost->title = $this->title;
        $jobPost->category_id = $this->category;
        // $jobPost->slug = Str::slug($this->title, '-');
        $jobPost->type_id = $this->type;
        $jobPost->sector_id = $this->sector;
        $jobPost->description = $this->description;
        $jobPost->no_of_post = $this->noOfPosts;
        $jobPost->organization_name = $this->organizationName;
        $jobPost->due_date_of_submission = $this->dueDate;
        $jobPost->created_by = Auth::guard('admin')->user()->id;
        $jobPost->published = 1;
        $jobPost->save();

        foreach ($this->attachments as $file) {
            if ($file['file'] !== null) {
                $jobFile = new JobFile();
                $jobFile->job_post_id = $jobPost->id;
                $jobFile->file = $file['file']->storePublicly('job_attachments', 'public');
                $jobFile->file_name = $file['file']->getClientOriginalName();
                $jobFile->file_size = $this->formatBytes($file['file']->getSize());
                $jobFile->save();
            }
        }

        JobNco::where('job_post_id', $jobPost->id)->delete();
        foreach ($this->nco as $nco) {
            $jobNco = new JobNco();
            $jobNco->job_post_id = $jobPost->id;
            $jobNco->nco_family_id = $nco;
            $jobNco->save();
        }
        //added rj

        // SendJobNotification::dispatch($this->nco, URL::to('/') . '/jobs/' . $jobPost->slug)->delay(3);






        // $userFamilyNcoList = UserNco::query()->whereHas('user', function ($q) {
        //     return $q->whereHas('basicInfo', function ($query) {
        //         return $query->where('status', 'Approved')
        //         ->where('card_valid_till', '>=', now());
        //     });
        // })
        // ->whereIn('family_id', $this->nco)->with('user')->get();


        // $ncoUserToNotify = [];
        // foreach ($userFamilyNcoList as $unco) {
        //     if (!array_key_exists($unco->user_id, $ncoUserToNotify)) {
        //         $ncoUserToNotify[$unco->user_id] = $unco->user->mobile_no;
        //     }
        // }

        // if (count($ncoUserToNotify) > 0) {
        //     SendJobNotification::dispatch(array_values($ncoUserToNotify), URL::to('/') . '/jobs/' . $jobPost->slug)->delay(5);
        // }
        //added rj

        //valpuia
            // $userFamilyNcoList = UserNco::whereIn('family_id', $this->nco)->with('user')->get();
            // $userIdForNotify = [];
            // $userPhoneNoToNotify = [];

            // foreach ($userFamilyNcoList as $unco) {
            //   if (!array_key_exists($unco->user_id, $userIdForNotify)) {
            //     $userIdForNotify[$unco->user_id] = $unco->user_id;
            //   }
            // }

            // $seniorityUserToNotify = BasicInfo::whereIn('user_id', $userIdForNotify)
            //   ->where('status', 'Approved')
            //   ->where('card_valid_till', '>=', now())
            //   ->orderBy('sponsorship_count', 'ASC')
            //   ->limit(20)
            //   ->get()
            //   ->toArray();

            // foreach ($seniorityUserToNotify as $nti) {
            //   $userPhoneNoToNotify[] = $nti['phone_no'];
            // }

            // if (count($userPhoneNoToNotify) > 0) {
            //   SendJobNotification::dispatch(array_values($userPhoneNoToNotify), URL::to('/') . '/jobs/' . $jobPost->slug)->delay(5);
            // }
        //valpuia

        return redirect()->route('jobsPost');
    }

    function formatBytes($size, $precision = 1)
    {
        $base = log($size, 1024);
        $suffixes = array('B', 'Kb', 'Mb', 'Gb', 'Tb');
        return round(pow(1024, $base - floor($base)), $precision) . ' ' . $suffixes[floor($base)];
    }

    public function cancel()
    {
        return redirect(route('jobsPost'));
    }

    public function hydrate()
    {
        $this->emit('select2AutoInit');
    }

    public function render()
    {
        return view('livewire.admin.placement');
    }
}
