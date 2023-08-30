<?php

namespace App\Http\Livewire\Admin\Employer;

use App\Models\Admin;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $categories;
    public $name;
    public $category;

    public function mount()
    {
        $this->categories = Category::orderBy('name', 'ASC')->get();
    }

    public function render()
    {
        return view('livewire.admin.employer.index', [
            'employers' => Admin::where('role_id', 4)
                ->when($this->category, fn ($q) => $q->where('category_id', $this->category))
                ->when($this->name, fn ($q) => $q->where('name', 'like', '%' . $this->name . '%'))
                ->with('organization', 'category')
                ->orderBy('is_approved', 'ASC')
                ->paginate(),
            'count_active' => Admin::query()->where('role_id', 4)->where('active', 1)->count(),
            'count_inactive' => Admin::query()->where('role_id', 4)->where('active', 0)->count()
        ]);
    }
}
