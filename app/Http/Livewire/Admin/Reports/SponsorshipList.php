<?php

namespace App\Http\Livewire\Admin\Reports;

use App\Models\AdminDistrict;
use App\Models\BasicInfo;
use App\Models\District;
use App\Models\Sponsorship;
use App\Models\SponsorshipMajorCore;
use App\Models\SponsorshipQualification;
use App\Models\SponsorshipSubject;
use App\Models\SponsorshipUser;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class SponsorshipList extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $districts;
    public $district;
    public $name;
    public $data;

    public $detailDialog = false;
    public $deleteDialog = false;
    public $sponsorshipFile;
    public $deletedId;

    public function openDetailDialog($id)
    {
        $this->detailDialog = true;
        $this->data = Sponsorship::findOrFail($id);
    }

    public function closeDialog()
    {
        $this->sponsorshipFile = null;
        $this->detailDialog = false;
        $this->data = null;
    }

    public function openDeleteDialog($id)
    {
        $this->deletedId = $id;
        $this->deleteDialog = true;
    }

    public function closeDeleteDialog()
    {
        $this->deletedId = null;
        $this->deleteDialog = false;
    }

    public function delete()
    {
        $data = Sponsorship::where('id', $this->deletedId)->first();
        if ($data->file) {
            Storage::disk('public')->delete($data->file);
        }
        Storage::disk('public')->delete($data->file_path);

        SponsorshipQualification::where('sponsorship_id', $this->deletedId)->delete();
        SponsorshipMajorCore::where('sponsorship_id', $this->deletedId)->delete();
        SponsorshipSubject::where('sponsorship_id', $this->deletedId)->delete();

        $users = SponsorshipUser::where('sponsorship_id', $this->deletedId)->get();
        foreach ($users as $user) {
            $info = BasicInfo::where('user_id', $user->user_id)->first();
            $info->sponsorship_count -= 1;
            $info->save();

            $user->delete();
        }

        $data->delete();

        $this->deleteDialog = false;
    }

    public function uploadProff($id)
    {
        $sponsor = Sponsorship::findOrFail($id);
        $sponsor->file = $this->sponsorshipFile->storePublicly('sponsorship', 'public');
        $sponsor->save();

        $this->closeDialog();
    }

    public function downloadExcel($id)
    {
        $sponsor = Sponsorship::findOrFail($id);
        return Storage::disk('public')->download($sponsor->file_path);
    }

    public function mount()
    {

        if (auth()->guard('admin')->user()->role_id == 1)
            $this->districts = District::orderBy('name', 'ASC')->get();
        else {

            $authDistricts = AdminDistrict::where('admin_id', auth()->guard('admin')->id())->pluck('district_id')->toArray();
            $this->districts = District::query()->whereIn('id', $authDistricts)->orderBy('name', 'ASC')->get();
        }
    }

    public function render()
    {
        return view('livewire.admin.reports.sponsorship-list', [
            'sponsorships' => Sponsorship::orderBy('created_at', 'DESC')
                ->with('qualification', 'subject', 'major_core')
                ->when($this->name, fn ($q) => $q->where('name', 'like', '%' . $this->name . '%'))
                ->when($this->district, fn ($q) => $q->where('district', $this->district))
                ->paginate(),
            'role_id' => auth()->guard('admin')->user()->role_id
        ]);
    }
}
