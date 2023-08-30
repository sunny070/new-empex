<?php

namespace App\Http\Livewire\Admin\Account\Expired;

// use App\Http\Livewire\Admin\ChangeRequest\Verify\BasicInfo;
use App\Models\Admin;
use App\Models\AdminDistrict;
use App\Models\BasicInfo;
use App\Models\Role;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $roles;
    public $role;
    public $name;

    public $deletedId;
    public $deleteDialog = false;
    // public $expired = [];

    // protected $listeners = ['nameChanged' => 'change'];

    public function openDeleteDialog($id)
    {
        // dd($id);
        $this->deletedId = $id;
        $this->deleteDialog = true;
    }


    public function change()
    {
        $this->mount();

        // dd($this->name);
    }

    public function closeDeleteDialog()
    {
        $this->deletedId = null;
        $this->deleteDialog = false;
    }




    public function deleteEmployee()
    {
        BasicInfo::find($this->deletedId)->delete();

        return redirect(route('admin.expired.accounts'));
    }

    public function mount()
    {
        $this->roles = Role::where('id', '!=', 4)->orderBy('name', 'ASC')->get();
        // BasicInfo::query()->whereDate('card_valid_till', '<', now())
        //     ->where('status', 'Approved')
        //     ->when(filled($this->name), function ($query) {
        //         return $query->where('full_name', 'LIKE', "%$this->name%");
        //     })
        //     ->get()->map(function (BasicInfo $q) {

        //         // return date_diff(date_create(card_valid_till),date_create(now()->toDateString()))->format('%M');
        //         $this_month = Carbon::parse($q->card_valid_till)->floorMonth(); // returns 2019-07-01
        //         $start_month = Carbon::parse(now())->floorMonth(); // returns 2019-06-01


        //         if ($start_month->diffInMonths($this_month)  > 3) {

        //             return array_push($this->expired, $q);
        //         }
        //     });

        // dd($this->expired);
    }

    public function render()
    {

        // dd('reder');

        // $data = [];
        BasicInfo::query()->whereDate('card_valid_till', '<', now())
        ->where('status', 'Approved')
        ->when(filled($this->name), function ($query) {
            return $query->where('full_name', 'LIKE', "%$this->name%");
        })
        ->get()->filter(function (BasicInfo $q) {

            // return date_diff(date_create(card_valid_till),date_create(now()->toDateString()))->format('%M');
            $this_month = Carbon::parse($q->card_valid_till)->floorMonth(); // returns 2019-07-01
            $start_month = Carbon::parse(now())->floorMonth(); // returns 2019-06-01


            if ($start_month->diffInMonths($this_month)  > 3) {

                //  array_push($this->expired, $q);
                return $q;
            }
        });
        return view('livewire.admin.account.expired.index', [
            'admins' => Admin::where('role_id', '!=', 4)
                ->when($this->role, fn ($q) => $q->where('role_id', $this->role))
                ->when($this->name, fn ($q) => $q->where('name', 'like', '%' . $this->name . '%'))
                ->with('district')
                ->paginate(),

            'expired' => BasicInfo::query()->whereDate('card_valid_till', '<', now())
            ->where('status', 'Approved')
            ->when(filled($this->name), function ($query) {
                return $query->where('full_name', 'LIKE', "%$this->name%");
            })
            ->get()->filter(function (BasicInfo $q) {

                // return date_diff(date_create(card_valid_till),date_create(now()->toDateString()))->format('%M');
                $this_month = Carbon::parse($q->card_valid_till)->floorMonth(); // returns 2019-07-01
                $start_month = Carbon::parse(now())->floorMonth(); // returns 2019-06-01


                if ($start_month->diffInMonths($this_month)  > 3) {

                    //  array_push($this->expired, $q);
                    return $q;
                }
            })
        ]);
    }
}
