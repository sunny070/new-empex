@extends('admin.controls.adminControls')
@section('control-section')
<div class="md:ml-5">
  <ul id="tabs" class="inline-flex w-full px-1 pt-2 text-gray-400">
    <li class="px-4 py-2 font-semibold">
      <a id="default-tab" href="#qualification">Qualification</a>
    </li>
    <li class="px-4 py-2 font-semibold">
      <a href="#subject">Subject</a>
    </li>
    <li class="px-4 py-2 font-semibold">
      <a href="#core">Major Core</a>
    </li>
  </ul>

  <!-- Tab Contents -->
  <div id="tab-contents">
    <div id="qualification">
      @livewire('admin.controls.education.qualification')
    </div>
    <div id="subject" class="hidden">
      @livewire('admin.controls.education.subject')
    </div>
    <div id="core" class="hidden">
      @livewire('admin.controls.education.core')
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