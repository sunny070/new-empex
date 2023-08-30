<?php

namespace App\Http\Livewire\Admin\Reports;

use App\Exports\EdistrictListExport;
use App\Models\Admin;
use App\Models\BasicInfo;
use App\Models\District;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class EdistrictUser extends Component
{


    public $reports;

    public $districts;
    public $district = [1, 11, 7, 2, 5];
    public $ids = [1, 11, 7, 2, 5];
    public $buttonEnable = true;
    public $generated = false;
    public $districtName;


    public function generateReport()
    {

        $this->reports = BasicInfo::query()
            ->whereIn('district_id', $this->ids)
            ->where('status', 'Pending')
            ->whereNotNull('employment_no')
            ->with([
                'permanent_address' => fn ($q) => $q->with('state', 'district'),
            ])
            ->with('district')
            ->get();

        // $this->districtName = $this->district != 'All' ? strtoupper(District::where('id', $this->district)->value('name')) : strtoupper($this->district);


        // $data =  District::query()->whereIn('id', $this->district)->pluck('name')->toArray();
        // // $data =  District::query()->->get(['name']);
        // $this->districtName = implode(',', $data);

        $this->generated = true;
        $this->buttonEnable = false;
    }

    public function downloadReport()
    {
        return Excel::download(new EdistrictListExport(
            $this->reports,
            $this->districtName,
        ), "$this->districtName.xlsx");
    }

    public function mount()
    {


        $ids = [1, 11, 7, 2, 5];

        // $this->districts =  Admin::query()->whereHas('district')->with(['district' => function ($query) {
        //     $query->select('admin_districts.id', 'name');
        // }])->get()->pluck('district');


        $this->districts = District::query()->whereIn('id', $ids)->pluck('name');

        // dd($this->districts);

        // dd($this->districts);

        $this->district = $ids;
        // $this->district = collect($this->districts[0])->pluck('id')->toArray();

        // dd($this->district);


        $data =  District::query()->whereIn('id', $this->district)->pluck('name')->toArray();
        // $data =  District::query()->->get(['name']);
        $this->districtName = implode(',', $data);


        // dd($this->districtName);

        $this->reports = collect();
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
        return view('livewire.admin.reports.edistrict-user');
    }
}
