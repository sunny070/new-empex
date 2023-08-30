<?php

namespace App\Http\Livewire\Web;

use App\Models\SponsoredNotification;
use Livewire\Component;
use Livewire\WithPagination;

class Notification extends Component
{
	use WithPagination;

	public function render()
	{
		return view('livewire.web.notification', [
			'notifications' => SponsoredNotification::where('user_id', auth()->id())->orderBy('is_read', 'asc')->paginate()
		]);
	}
}
