<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\JobFile;
use App\Models\JobNco;
use App\Models\JobPost;
use App\Models\NcoDetail;
use App\Models\NcoFamily;
use App\Models\NcoGroup;
use App\Models\Sector;
use App\Models\Type;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class EditJob extends Component
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
  public $jobId;
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

  public function mount($job)
  {
    // dd('mount');
    $this->categories = Category::get();
    $this->sectors = Sector::get();
    $this->ncoOccupation = NcoFamily::orderBy('name', 'ASC')->get();

    $this->types = Type::where('category_id', $job->category_id)->get();

    $attachments = JobFile::where('job_post_id', $job->id)->get();
    foreach ($attachments as $file) {
      $this->jobAttachments[] = $file;
    }

    $jobNco = JobNco::where('job_post_id', $job->id)->get();
    foreach ($jobNco as $jnco) {
      $this->nco[] = $jnco->nco_family_id;
    }

    $this->jobId = $job->id;

    $this->category = $job->category_id;
    $this->type = $job->type_id;
    $this->sector = $job->sector_id;
    $this->title = $job->title;
    $this->description = $job->description;
    $this->noOfPosts = $job->no_of_post;
    $this->dueDate = $job->due_date_of_submission;
    $this->organizationName = $job->organization_name;
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

  public function deleteAttachment($fileId, $index)
  {
    $file = JobFile::where('id', $fileId)->first();
    Storage::disk('public')->delete($file->file);
    $file->delete();
    unset($this->jobAttachments[$index]);
    $this->jobAttachments = array_values($this->jobAttachments);
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
      ]
    );

    $jobPost = JobPost::findOrFail($this->jobId);

    $jobPost->title = $this->title;
    $jobPost->category_id = 1;
    // $jobPost->slug = Str::slug($this->title, '-');
    $jobPost->type_id = $this->type;
    $jobPost->sector_id = $this->sector;
    $jobPost->description = $this->description;
    $jobPost->no_of_post = $this->noOfPosts;
    $jobPost->organization_name = $this->organizationName;
    $jobPost->due_date_of_submission = $this->dueDate;
    $jobPost->created_by = Auth::guard('admin')->user()->id;
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

    return redirect()->route('jobsPost');
  }

  function formatBytes($size, $precision = 1)
  {
    $base = log($size, 1024);
    $suffixes = array('b', 'Kb', 'Mb', 'Gb', 'Tb');
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
    return view('livewire.admin.edit-job');
  }
}
