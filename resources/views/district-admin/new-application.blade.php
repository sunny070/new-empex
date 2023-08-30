@extends('layouts.district.app')

@section('title', 'District Admin - New Application')

@section('navbar')
    @parent
@endsection

@section('content')
    <div class="max-w-7xl mx-auto px-4 my-5">
        <div class="mt-2">
            <div class="rounded w-full">
                <ul id="tabs" class="grid grid-cols-3 md:grid-cols-9 text-gray-400">
                    <li class="py-2 font-semibold">
                        @if ($pending > 0)

                            <span class="inline-block w-2 h-2 bg-empex-red mb-1 rounded-full"></span>
                        @endif
                        <a id="default-tab" href="#pendingApp">Pending</a>
                    </li>
                    <li class="py-2 font-semibold">
                        @if ($verified > 0)
                            <span class="inline-block w-2 h-2 bg-empex-red mb-1 rounded-full"></span>
                        @endif
                        <a href="#verifyApp">Verified</a>
                    </li>


                    {{-- <li class="py-2 font-semibold">
                        @if ($newID > 0)
                            <span class="inline-block w-2 h-2 bg-empex-red mb-1 rounded-full"></span>
                        @endif
                        <a href="#newID">New ID</a>
                    </li> --}}
                </ul>

                <div id="tab-contents" class="mt-4">
                    <div id="pendingApp" class="">
                        @livewire('district.new-application.pending')
                    </div>
                    <div id="verifyApp" class="hidden">
                        @livewire('district.new-application.verified')
                    </div>
                    <div id="newID" class="hidden">
                        @livewire('district.new-application.new-id')
                    </div>
                </div>
            </div>
        </div>
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
                    tabTogglers[i].parentElement.classList.remove("border-empex-green", "border-b-2",
                        "text-gray-800");
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
