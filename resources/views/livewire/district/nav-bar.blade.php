<div class="flex flex-col flex-grow md:justify-end md:flex-row">
    <a class="px-4 py-2 mt-2 text-sm font-semibold rounded-lg hover:text-empex-green md:mt-0 {{ request()->is('district-admin/dashboard') ? 'active' : '' }}"
        href="{{ route('district-admin.dashboard') }}">
        Dashboard
    </a>

    <a class="px-4 py-2 mt-2 text-sm font-semibold rounded-lg hover:text-empex-green md:mt-0 {{ request()->is('district-admin/new-application') || request()->is('district-admin/new-application/*') ? 'active' : '' }}"
        href="{{ route('district-admin.new-application') }}">
        @if ($newApp > 0)
        <span class="inline-block w-2 h-2 bg-empex-red mb-1 rounded-full"></span>
        @endif
        New Application
    </a>

    <x-jet-dropdown align="left">
        <x-slot name="trigger">
            <button
                class="{{ request()->is('district-admin/change/*') ? 'active' : '' }} px-4 py-2 mt-2 text-sm font-semibold rounded-lg hover:text-empex-green md:mt-0 flex justify-between md:justify-start w-full">
                <span>
                    @if ($verifyChange > 0 || $approveChange > 0)
                    <span class="inline-block w-2 h-2 bg-empex-red mb-1 rounded-full"></span>
                    @endif
                    Changes
                </span>
                <svg class="fill-current h-4 w-4 float-right" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                </svg>
            </button>
        </x-slot>
        <x-slot name="content">
            <x-jet-dropdown-link href="{{ route('district-admin.change.verification') }}"
                class="{{ request()->is('district-admin/change/verification') ? 'active' : '' }}">
                Verification
                <span class="float-right font-bold text-empex-green">{{ $verifyChange > 0 ? $verifyChange : '' }}</span>
            </x-jet-dropdown-link>
            <x-jet-dropdown-link href="{{ route('district-admin.change.approval') }}"
                class="{{ request()->is('district-admin/change/approval') ? 'active' : '' }}">
                Approval
                <span class="float-right font-bold text-empex-green">{{ $approveChange > 0 ? $approveChange : ''
                    }}</span>
            </x-jet-dropdown-link>
        </x-slot>
    </x-jet-dropdown>


    <x-jet-dropdown align="left">
        <x-slot name="trigger">
            <button
                class="{{ request()->is('district-admin/report*') ? 'active' : '' }} px-4 py-2 mt-2 text-sm font-semibold rounded-lg hover:text-empex-green md:mt-0 flex justify-between md:justify-start w-full">
                <span class="mr-1">Reports</span>
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                </svg>
            </button>
        </x-slot>
        <x-slot name="content">
            <x-jet-dropdown-link href="{{ Route('district-admin.report.total.registration') }}"
                class="{{ request()->is('district-admin/report/total-registration') ? 'active' : '' }}">
                Total registrations
            </x-jet-dropdown-link>
            <x-jet-dropdown-link href="{{ Route('district-admin.report.registered.user') }}"
                class="{{ request()->is('district-admin/report/registered-user') ? 'active' : '' }}">
                Registered users
            </x-jet-dropdown-link>
            <x-jet-dropdown-link href="{{ Route('district-admin.report.sponsorship') }}"
                class="{{ request()->is('district-admin/report/sponsorship') ? 'active' : '' }}">
                Sponsorships
            </x-jet-dropdown-link>

        </x-slot>
    </x-jet-dropdown>

    <a class="px-4 py-2 mt-2 text-sm font-semibold rounded-lg hover:text-empex-green md:mt-0 {{ request()->is('district-admin/renew') ? 'active' : '' }}"
        href="{{ route('district-admin.renew') }}">
        @if ($renew > 0)
        <span class="inline-block w-2 h-2 bg-empex-red mb-1 rounded-full"></span>
        @endif
        Renewal
    </a>
    <a class="px-4 py-2 mt-2 text-sm font-semibold rounded-lg hover:text-empex-green md:mt-0 {{ request()->route()->getName() == 'district-admin.placement' ? 'active' : '' }}"
        href="{{ route('district-admin.placement',['district' => $district_id]) }}">

        Placement
    </a>

    <a class="px-4 py-2 mt-2 text-sm font-semibold rounded-lg hover:text-empex-green md:mt-0 {{ request()->is('district-admin/employee') || request()->is('district-admin/employee/*') ? 'active' : '' }}"
        href="{{ route('district-admin.employee') }}">
        Employee
    </a>

    <a class="px-4 py-2 mt-2 text-sm font-semibold rounded-lg hover:text-empex-green md:mt-0 {{ request()->is('district-admin/account') ? 'active' : '' }}"
        href="{{ route('district-admin.account') }}">
        Accounts
    </a>

    <form action="{{ route('admin.logout') }}" method="post">
        @csrf
        <button type="submit" class="px-4 py-2 mt-2 text-sm font-semibold md:mt-0 md:hover:text-empex-green">
            <span>Logout</span>
        </button>
    </form>
</div>
