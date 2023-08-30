<div class="mt-4"
    x-data="{ verificationDropdown: false, approvalDropdown: false, accountsDropdown: false, reportDropdown: false, }">
    <div class="md:max-w-7xl md:mx-auto md:px-4 flex justify-center">
        <div class="container">
            <div class="flex">
                <div
                    class="font-sans md:border-b-4 border-empex-yellow flex flex-col text-left sm:flex-row sm:text-left py-1 sm:items-baseline w-full">
                    <x-jet-nav-link href="{{ Route('dashboard') }}" :active="request()->is('admin/dashboard')"
                        class="p-2">
                        Dashboard</x-jet-nav-link>
                    {{-- verification --}}
                    <x-jet-dropdown align="left">
                        <x-slot name="trigger">
                            <button
                                class="{{ request()->is('admin/verify*') ? 'text-empex-green bg-empex-gray' : '' }} hover:text-empex-green hover:bg-empex-gray p-2 font-semibold no-underline md:ml-4 active:outline-none focus:outline-none inline-flex w-full justify-between md:justify-start">
                                <span>
                                    @if ($verifyNew > 0 || $verifyChange > 0)
                                    <span class="inline-block mb-1 w-2 h-2 bg-red-600 rounded-full"></span>
                                    @endif
                                    Verification
                                </span>
                                <svg class="fill-current h-4 w-4 float-right" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                </svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-jet-dropdown-link href="{{ Route('admin.verify.new.application') }}"
                                class="{{ request()->is('admin/verify/new-application') || request()->is('admin/verify/new-application/*') ? 'active' : '' }}">
                                New application
                                <span class="float-right font-bold text-empex-green">{{ $verifyNew > 0 ? $verifyNew : ''
                                    }}</span>
                            </x-jet-dropdown-link>
                            <x-jet-dropdown-link href="{{ Route('admin.verify.change.request') }}"
                                class="{{ request()->is('admin/verify/change-request') ? 'active' : '' }}">
                                Change requests
                                <span class="float-right font-bold text-empex-green">{{ $verifyChange > 0 ?
                                    $verifyChange : '' }}</span>
                            </x-jet-dropdown-link>
                        </x-slot>
                    </x-jet-dropdown>

                    {{-- approval --}}
                    <x-jet-dropdown align="left">
                        <x-slot name="trigger">
                            <button
                                class="{{ request()->is('admin/approve*') ? 'text-empex-green bg-empex-gray' : '' }} hover:text-empex-green hover:bg-empex-gray p-2 font-semibold no-underline md:ml-4 active:outline-none focus:outline-none inline-flex w-full justify-between md:justify-start">
                                <span>
                                    @if ($approveNew > 0 || $approveChange > 0 || $approveRenew > 0)
                                    <span class="inline-block w-2 h-2 mb-1 bg-red-600 rounded-full"></span>
                                    @endif
                                    Approval
                                </span>
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                </svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-jet-dropdown-link href="{{ Route('admin.approve.new.application') }}"
                                class="{{ request()->is('admin/approve/new-application') ? 'active' : '' }}">
                                New application
                                <span class="float-right font-bold text-empex-green">{{ $approveNew > 0 ? $approveNew :
                                    '' }}</span>
                            </x-jet-dropdown-link>

                            {{-- <x-jet-dropdown-link href="{{ Route('admin.approve.new.id') }}"
                                class="{{ request()->is('admin/approve/new-id') ? 'active' : '' }}">
                                New ID
                                <span class="float-right font-bold text-empex-green">{{ $newId > 0 ? $newId : ''
                                    }}</span>
                            </x-jet-dropdown-link> --}}


                            <x-jet-dropdown-link href="{{ Route('admin.approve.renewal') }}"
                                class="{{ request()->is('admin/approve/renewal') ? 'active' : '' }}">
                                Renewal
                                <span class="float-right font-bold text-empex-green">{{ $approveRenew > 0 ?
                                    $approveRenew : '' }}</span>
                            </x-jet-dropdown-link>
                            <x-jet-dropdown-link href="{{ Route('admin.approve.change.request') }}"
                                class="{{ request()->is('admin/approve/change-request') ? 'active' : '' }}">
                                Change requests
                                <span class="float-right font-bold text-empex-green">{{ $approveChange > 0 ?
                                    $approveChange : '' }}</span>
                            </x-jet-dropdown-link>
                        </x-slot>
                    </x-jet-dropdown>

                    {{-- accounts --}}
                    <x-jet-dropdown align="left">
                        <x-slot name="trigger">
                            <button
                                class="{{ request()->is('admin/account*') ? 'text-empex-green bg-empex-gray' : '' }} hover:text-empex-green hover:bg-empex-gray p-2 font-semibold no-underline md:ml-4 active:outline-none focus:outline-none inline-flex w-full justify-between md:justify-start">
                                <span class="mr-1">Accounts</span>
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                </svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-jet-dropdown-link href="{{ Route('admin.user.accounts') }}"
                                class="{{ request()->is('admin/account/user-accounts') ? 'active' : '' }}">
                                Employee List
                            </x-jet-dropdown-link>
                            <x-jet-dropdown-link href="{{ Route('admin.official.accounts') }}"
                                class="{{ request()->is('admin/account/official-accounts') ? 'active' : '' }}">
                                Official accounts
                            </x-jet-dropdown-link>
                            <x-jet-dropdown-link href="{{ Route('admin.expired.accounts') }}"
                                class="{{ request()->is('admin/account/expired-accounts') ? 'active' : '' }}">
                                Expired Accounts
                            </x-jet-dropdown-link>
                        </x-slot>
                    </x-jet-dropdown>

                    <x-jet-nav-link href="{{ Route('admin.employer') }}" :active="request()->is('admin/employer*')"
                        class="p-2 md:ml-4">
                        @if ($employerNoti > 0)
                        <span class="inline-block w-2 h-2 mb-1 bg-red-600 rounded-full"></span>
                        @endif
                        Employer
                    </x-jet-nav-link>

                    <x-jet-nav-link href="{{ Route('jobsPost') }}" :active="request()->is('admin/employee-news*')"
                        class="p-2 md:ml-4"> Employment News
                    </x-jet-nav-link>
                    <x-jet-nav-link href="{{ Route('admin.placement',['district'=>1]) }}"
                        :active="request()->route()->getName() == 'admin.placement'" class="p-2 md:ml-4">Placement
                    </x-jet-nav-link>
                    <x-jet-nav-link href="{{ Route('employeeNews') }}" :active="request()->is('admin/career-guidance*')"
                        class="p-2 md:ml-4">Career
                        Guidance / Articles</x-jet-nav-link>

                    {{-- report --}}
                    <x-jet-dropdown align="left">
                        <x-slot name="trigger">
                            <button
                                class="{{ request()->is('admin/report*') ? 'text-empex-green bg-empex-gray' : '' }} hover:text-empex-green hover:bg-empex-gray p-2 font-semibold no-underline md:ml-4 active:outline-none focus:outline-none inline-flex w-full justify-between md:justify-start">
                                <span class="mr-1">Reports</span>
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                </svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-jet-dropdown-link href="{{ Route('admin.report.total.registration') }}"
                                class="{{ request()->is('admin/report/total-registration') ? 'active' : '' }}">
                                Total registrations
                            </x-jet-dropdown-link>
                            <x-jet-dropdown-link href="{{ Route('admin.report.registered.user') }}"
                                class="{{ request()->is('admin/report/registered-user') ? 'active' : '' }}">
                                Registered users
                            </x-jet-dropdown-link>
                            <x-jet-dropdown-link href="{{ Route('admin.report.sponsorship') }}"
                                class="{{ request()->is('admin/report/sponsorship') ? 'active' : '' }}">
                                Sponsorships</x-jet-dropdown-link>

                            {{-- <x-jet-dropdown-link href="{{ Route('admin.report.edistrict.user') }}"
                                class="{{ request()->is('admin/report/edistrict-user') ? 'active' : '' }}">
                                Edistrict Data
                            </x-jet-dropdown-link> --}}
                        </x-slot>
                    </x-jet-dropdown>

                    <x-jet-nav-link href="{{ Route('admin.controls.address') }}"
                        :active="request()->is('admin/admin-controls*')" class="p-2 md:ml-4 hidden md:flex">Admin
                        Controls</x-jet-nav-link>

                    {{-- admin control mobile --}}
                    <x-jet-dropdown align="left">
                        <x-slot name="trigger">
                            <button
                                class="{{ request()->is('admin/admin-controls*') ? 'text-empex-green bg-empex-gray' : '' }} hover:text-empex-green hover:bg-empex-gray p-2 font-semibold no-underline md:ml-4 active:outline-none focus:outline-none inline-flex w-full justify-between md:justify-start md:hidden">
                                <span class="mr-1">Admin Controls</span>
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                </svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-jet-dropdown-link href="{{ Route('admin.controls.address') }}"
                                class="{{ request()->is('admin/admin-controls/address') ? 'active' : '' }}">
                                Address
                            </x-jet-dropdown-link>
                            <x-jet-dropdown-link href="{{ Route('admin.controls.departments') }}"
                                class="{{ request()->is('admin/admin-controls/departments') ? 'active' : '' }}">
                                Departments
                            </x-jet-dropdown-link>
                            <x-jet-dropdown-link href="{{ Route('admin.controls.languages') }}"
                                class="{{ request()->is('admin/admin-controls/languages') ? 'active' : '' }}">
                                Languages
                            </x-jet-dropdown-link>
                            <x-jet-dropdown-link href="{{ Route('admin.controls.challenges') }}"
                                class="{{ request()->is('admin/admin-controls/physical-challenge') ? 'active' : '' }}">
                                Physical Challenge
                            </x-jet-dropdown-link>
                            <x-jet-dropdown-link href="{{ Route('admin.controls.education') }}"
                                class="{{ request()->is('admin/admin-controls/education') ? 'active' : '' }}">
                                Education
                            </x-jet-dropdown-link>
                            <x-jet-dropdown-link href="{{ Route('admin.controls.nco') }}"
                                class="{{ request()->is('admin/admin-controls/nco') ? 'active' : '' }}">
                                Nco
                            </x-jet-dropdown-link>
                            <x-jet-dropdown-link href="{{ Route('admin.controls.organization') }}"
                                class="{{ request()->is('admin/admin-controls/organization') ? 'active' : '' }}">
                                Organization
                            </x-jet-dropdown-link>
                            <x-jet-dropdown-link href="{{ Route('admin.controls.terms') }}"
                                class="{{ request()->is('admin/admin-controls/terms') ? 'active' : '' }}">
                                Terms & Condition
                            </x-jet-dropdown-link>
                            <x-jet-dropdown-link href="{{ Route('admin.controls.authority') }}"
                                class="{{ request()->is('admin/admin-controls/registering-authority') ? 'active' : '' }}">
                                Registering Authority
                            </x-jet-dropdown-link>
                        </x-slot>
                    </x-jet-dropdown>

                    <x-jet-nav-link href="{{ Route('admin.notice.board') }}"
                        :active="request()->is('admin/notice-board')" class="p-2 md:ml-4">
                        Notice Board</x-jet-nav-link>
                </div>
            </div>
        </div>
    </div>
</div>
