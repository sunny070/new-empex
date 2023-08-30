@extends('admin.controls.adminControls')
@section('control-section')
<div class="md:ml-5">
  <ul id="tabs" class="grid grid-cols-3 md:grid-cols-6 gap-4 w-full px-1 pt-2 text-gray-400">
    <li class="px-4 py-2 font-semibold">
      <a id="default-tab" href="#state">State</a>
    </li>
    <li class="px-4 py-2 font-semibold">
      <a href="#district">District</a>
    </li>
    <li class="px-4 py-2 font-semibold">
      <a href="#ps">Police Station</a>
    </li>
    <li class="px-4 py-2 font-semibold">
      <a href="#po">Post Office</a>
    </li>
    <li class="px-4 py-2 font-semibold">
      <a href="#rdblock">RD Block</a>
    </li>
  </ul>

  <div id="tab-contents">
    <div id="state">
      @livewire('admin.controls.address.state')
    </div>
    <div id="district" class="hidden">
      @livewire('admin.controls.address.district')
    </div>
    <div id="ps" class="hidden">
      @livewire('admin.controls.address.police-station')
    </div>
    <div id="po" class="hidden">
      @livewire('admin.controls.address.post-office')
    </div>
    <div id="rdblock" class="hidden">
      @livewire('admin.controls.address.rd-block')
    </div>
  </div>
</div>

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