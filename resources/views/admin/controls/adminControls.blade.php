@extends('layouts.admin')
@section('content')
<div class="py-5">
  <div class="max-w-7xl mx-auto px-4">
    <div class="flex flex-row">
      <div class="hidden md:flex flex-col bg-white w-3/12 rounded-lg border border-empex-gray"
        style="height: max-content">
        <ul>
          <a href="{{ Route('admin.controls.address') }}">
            <li
              class="{{ request()->is('admin/admin-controls/address') ? 'text-empex-green' : '' }} p-3 rounded-lg hover:text-empex-green hover:cursor-pointer">
              Address
            </li>
          </a>
          <a href="{{ Route('admin.controls.departments') }}">
            <li
              class="{{ request()->is('admin/admin-controls/departments') ? 'text-empex-green' : '' }} p-3 rounded-lg hover:text-empex-green hover:cursor-pointer">
              Departments
            </li>
          </a>
          <a href="{{ Route('admin.controls.languages') }}">
            <li
              class="{{ request()->is('admin/admin-controls/languages') ? 'text-empex-green' : '' }} p-3 rounded-lg hover:text-empex-green hover:cursor-pointer">
              Languages
            </li>
          </a>
          <a href="{{ Route('admin.controls.challenges') }}">
            <li
              class="{{ request()->is('admin/admin-controls/physical-challenge') ? 'text-empex-green' : '' }} p-3 rounded-lg hover:text-empex-green hover:cursor-pointer">
              Physical Challenge
            </li>
          </a>
          <a href="{{ Route('admin.controls.education') }}">
            <li
              class="{{ request()->is('admin/admin-controls/education') ? 'text-empex-green' : '' }} p-3 rounded-lg hover:text-empex-green hover:cursor-pointer">
              Education
            </li>
          </a>
          <a href="{{ Route('admin.controls.nco') }}">
            <li
              class="{{ request()->is('admin/admin-controls/nco') ? 'text-empex-green' : '' }} p-3 rounded-lg hover:text-empex-green hover:cursor-pointer">
              NCO
            </li>
          </a>
          <a href="{{ Route('admin.controls.organization') }}">
            <li
              class="{{ request()->is('admin/admin-controls/organization') ? 'text-empex-green' : '' }} p-3 rounded-lg hover:text-empex-green hover:cursor-pointer">
              Organization
            </li>
          </a>
          <a href="{{ Route('admin.controls.terms') }}">
            <li
              class="{{ request()->is('admin/admin-controls/terms') ? 'text-empex-green' : '' }} p-3 rounded-lg hover:text-empex-green hover:cursor-pointer">
              Terms & Condition
            </li>
          </a>
          <a href="{{ Route('admin.controls.authority') }}">
            <li
              class="{{ request()->is('admin/admin-controls/registering-authority') ? 'text-empex-green' : '' }} p-3 rounded-lg hover:text-empex-green hover:cursor-pointer">
              Registering Authority
            </li>
          </a>
        </ul>
      </div>
      <div class="flex flex-col w-full">
        @yield('control-section')
      </div>
    </div>
  </div>
</div>
@endsection