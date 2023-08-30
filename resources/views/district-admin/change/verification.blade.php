@extends('layouts.district.app')

@section('title', 'District Admin - Verification')

@section('navbar')
@parent
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 my-5">
  @livewire('district.changes.verification.index')
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
