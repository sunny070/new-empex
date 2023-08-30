<div>
    <x-loading-indicator />
	<div class="px-5 pb-5">
		<div>
			After clicking renew, you'll have to wait for admin approval to get the new card validity
		</div>

		<div class="flex justify-between mt-5">
			<div class="text-gray-400">Card Valid Till</div>
			<div class="{{ date('Y-m-d') > $info->card_valid_till ? 'text-empex-red' : ''}}">{{ date('d M Y',
				strtotime($info->card_valid_till))
				}}</div>
		</div>

		<div class="flex justify-between mt-5">
			<div class="text-gray-400">Validity Days left</div>
			<div>{!! $daysLeft !!}</div>
		</div>
		<div class="mt-5">
			<button wire:click.prevent="makePayment"
				class="bg-empex-green text-gray-100 rounded hover:bg-green-500 px-6 py-1 focus:outline-none">Renew</button>
		</div>
	</div>
</div>
