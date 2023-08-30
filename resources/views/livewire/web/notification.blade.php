<div class="mt-5">
	<div class="flex flex-col w-full">
		<div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
			<div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
				<div class="shadow overflow-hidden border-b">
					<table class="min-w-full divide-y divide-gray-200">
						<thead>
							<tr>
								<th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wide">
									User ID
								</th>
								<th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wide">
									Received At
								</th>
								<th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wide">
									Is Read
								</th>
								<th scope="col" class="px-6 py-3 text-xs font-medium uppercase tracking-wide text-right">
									Action
								</th>
							</tr>
						</thead>
						<tbody class="bg-white divide-y divide-gray-200">
							@forelse($notifications as $noti)
							<tr class="hover:bg-gray-50">
								<td class="px-6 py-4 whitespace-nowrap">
									{{ $noti->user_id }}
								</td>
								<td class="px-6 py-4 whitespace-nowrap">
									{{ $noti->created_at->format('d M Y') }}
								</td>
								<td class="px-6 py-4 whitespace-nowrap">
									{{ $noti->is_read == 0 ? 'No' : 'Yes' }}
								</td>
								<td class="px-6 py-4 whitespace-nowrap float-right">
									<a href="{{ route('auth.notification.detail', $noti->id) }}">
										<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
											stroke="currentColor" class="w-6 h-6">
											<path stroke-linecap="round" stroke-linejoin="round"
												d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
											<path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
										</svg>
									</a>
								</td>
							</tr>
							@empty
							<tr>
								<td class="px-6 py-4 whitespace-nowrap" colspan="7">Notification not found</td>
							</tr>
							@endforelse
						</tbody>
					</table>
				</div>
				<div class="mt-5">
					{{ $notifications->onEachSide(1)->links() }}
				</div>
			</div>
		</div>
	</div>
</div>