@extends('layouts.web.app')

@section('title', 'Ongoing Applications - Empex')

@section('navbar')
@parent
@endsection

@section('content')
<div class="w-full py-5">
  <div class="max-w-7xl mx-auto px-4">
    <div class="w-full">
      <div class=" text-sm font-semibold ml-5 my-3">
        Ongoing applications
      </div>
    </div>
    <div class="w-full md:bg-white md:rounded md:shadow md:border md:mb-0">
      <div class="md:px-6 md:py-4">
        <ul>
          @forelse ($applications as $application)
          <li class="p-3 md:border-b border-gray-200 border md:border-0 bg-white">
            <div class="font-semibold py-1 px-3 rounded w-max text-xs mb-2"
              style="color: {{ $application->color }}; background-color: {{ $application->bg }}">{{ $application->type
              }}</div>

            <div class="flex justify-between mb-2">
              <span class="font-semibold">{{ $application->user->name }}</span>
              @if ($application->status == 'Rejected')
              <button type="button" class="removeOngoing" data-id="{{ $application->id }}"
                onclick="openPopover(event,'deleteOngoing')">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-flex text-empex-red" fill="none"
                  viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
              </button>

              <div
                class="hidden bg-white border mr-3 z-50 font-normal leading-normal text-sm max-w-xs no-underline break-words rounded-lg w-52 shadow text-center"
                id="deleteOngoing">
                <form action="" method="POST" id="removeOngoingForm">
                  @csrf
                  <div class="text-gray-700 opacity-75 font-semibold p-3 mb-0 rounded-t-lg">
                    Delete Application?
                  </div>
                  <input type="hidden" id="ongoingId">
                  <div class="text-gray-700 p-3 flex justify-between">
                    <button type="submit" class="border bg-empex-red text-white px-5 rounded-md py-1">Yes</button>
                    <button type="button" class="border bg-white text-gray-400 px-5 rounded-md py-1"
                      onclick="openPopover(event,'deleteOngoing')">No</button>
                  </div>
                </form>
              </div>
              @endif
            </div>

            <div class="text-gray-500 text-xs mt-2">
              <span class="{{ $application->status == 'Rejected' ? 'text-empex-red' : '' }} mr-3">{{
                $application->status }}</span>|
              <span class="ml-3">{{ date('d M Y', strtotime($application->created_at)) }}</span>
            </div>
            @if ($application->status == 'Rejected')
            <div class="text-empex-red mt-3">
              Rejection Note: {{ $application->rejection_note ?? 'null' }}
            </div>
            @endif
            <button
              class="text-empex-green border-empex-green mt-5 font-medium openStatus border px-3 rounded hover:bg-empex-gray"
              data-id="{{ $application->id }}" data-type="{{ $application->type }}"
              data-name="{{ $application->user->name }}" data-color="{{ $application->color }}"
              data-bg="{{ $application->bg }}">Track</button>
          </li>
          @empty
          <div class="font-normal p-3">No application found</div>
          @endforelse
        </ul>

        <div class="py-2">
          {{ $applications->links() }}
        </div>
      </div>
    </div>
  </div>
</div>

{{-- tracking modal --}}
<div class="fixed z-10 inset-0 invisible overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true"
  id="statusDialog">
  <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">​</span>
    <div
      class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle md:max-w-lg w-full">
      <div class="px-4 py-3 border-b border-dotted">
        <div class="flex justify-between">
          <span>Tracking</span>
          <button class="closeStatus text-lg text-gray-400 font-medium">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd"
                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                clip-rule="evenodd" />
            </svg>
          </button>
        </div>
        <div id="statusType" class="py-1 px-3 mb-2 mt-5 font-semibold text-xs w-max rounded"></div>
        <div id="statusName" class="font-semibold"></div>
      </div>
      <div class="bg-white px-4 pb-4 mt-2">
        @livewire('web.track-status')
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function () {
    $('.openStatus').on('click', function(e){
      $('#statusDialog').removeClass('invisible');
      var id = $(this).data('id');
      var name = $(this).data('name');
      var type = $(this).data('type');
      var color = $(this).data('color');
      var bg = $(this).data('bg');
      Livewire.emit('openOngoingApplication', id);
      $('#statusName').html(name);
      $('#statusType').html(type);
      $('#statusType').css('color', color);
      $('#statusType').css('background-color', bg);
    });

    $('.closeStatus').on('click', function(e){
      $('#statusDialog').addClass('invisible');
    });
  });

  $(document).on('click', '.removeOngoing', function () {
    var id = $(this).data('id');
    $('#removeOngoingForm').attr('action', '/auth/employee/ongoing-remove/' + id);
  });
</script>
@endsection

@section('footer')
@parent
@endsection

@section('copyright')
@parent
@endsection