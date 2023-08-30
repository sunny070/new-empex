@extends('layouts.admin')
@section('content')
{{-- <div class="py-5">
  <div class="max-w-7xl mx-auto px-4">
    <h1 class="text-gray-600 font-semibold dark:text-gray-200">Approve Change Requests</h1>
    <div class="pt-2 lg:flex items-center justify-between">
      <div class="rounded w-full bg-white md:p-4 p-2 border border-empex-gray">
        <ul id="tabs" class="grid grid-cols-2 md:grid-cols-9 text-gray-400">
          <li class="px-4 py-2 font-semibold">
            @if (count($changeBasicInfos) > 0)
            <span class="inline-block w-2 h-2 bg-red-600 mb-1 rounded-full"></span>
            @endif
            <a id="default-tab" href="#basicInfo">Basic Info</a>
          </li>
          <li class="px-4 py-2 font-semibold">
            @if (count($changeAddresses) > 0)
            <span class="inline-block w-2 h-2 bg-red-600 mb-1 rounded-full"></span>
            @endif
            <a href="#address">Address</a>
          </li>
          <li class="px-4 py-2 font-semibold">
            @if (count($changeEducations) > 0)
            <span class="inline-block w-2 h-2 bg-red-600 mb-1 rounded-full"></span>
            @endif
            <a href="#education">Education</a>
          </li>
          <li class="px-4 py-2 font-semibold">
            @if (count($changeExperiences) > 0)
            <span class="inline-block w-2 h-2 bg-red-600 mb-1 rounded-full"></span>
            @endif
            <a href="#experience">Experience</a>
          </li>
          <li class="px-4 py-2 font-semibold">
            @if (count($transfer) > 0)
            <span class="inline-block w-2 h-2 bg-red-600 mb-1 rounded-full"></span>
            @endif
            <a href="#transfer">Transfer</a>
          </li>
        </ul>

        <div id="tab-contents">
          <div id="basicInfo" class="md:p-4 p-2">
            @include('admin.approval.changeRequestContents.basicInfo', ['basicInfos' => $changeBasicInfos])
          </div>
          <div id="address" class="hidden md:p-4 p-2">
            @include('admin.approval.changeRequestContents.address', ['addresses' => $changeAddresses])
          </div>
          <div id="education" class="hidden md:p-4 p-2">
            @include('admin.approval.changeRequestContents.education', ['educations' => $changeEducations])
          </div>
          <div id="experience" class="hidden md:p-4 p-2">
            @include('admin.approval.changeRequestContents.experience', ['experiences' => $changeExperiences])
          </div>
          <div id="transfer" class="hidden md:p-4 p-2">
            @include('admin.approval.changeRequestContents.transfer', ['transfers' => $transfer])
          </div>
        </div>
      </div>
    </div>
  </div>
</div> --}}

<div class="max-w-7xl mx-auto px-4 py-5">
  <h1 class="text-gray-600 font-semibold dark:text-gray-200">Approve Change Requests</h1>
  @livewire('admin.approval.change.index')
</div>
@endsection

@section('loadedScripts')
<script>
  let tabsContainer = document.querySelector("#tabs");
    let tabTogglers = tabsContainer.querySelectorAll("a");

    tabTogglers.forEach(function(toggler) {
      toggler.addEventListener("click", function(e) {
        e.preventDefault();
        let tabName = this.getAttribute("href");
        let tabContents = document.querySelector("#tab-contents");

        for (let i = 0; i < tabContents.children.length; i++) {
          tabTogglers[i].parentElement.classList.remove("border-empex-green", "border-b-2", "text-gray-800");
          tabContents.children[i].classList.remove("hidden");
          if ("#" + tabContents.children[i].id === tabName) {
            continue;
          }
          tabContents.children[i].classList.add("hidden");

        }
        e.target.parentElement.classList.add("border-empex-green", "border-b-2", "text-gray-800");
      });
    });
    document.getElementById("default-tab").click();
</script>
@endsection