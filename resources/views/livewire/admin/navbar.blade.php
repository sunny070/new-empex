<div x-data="{ userMenu: false }" class="w-full bg-white shadow-lg border-b border-gray-200">
  <div x-data="{ mobileMenu: false }"
    class="max-w-7xl mx-auto px-4 flex flex-col md:items-center md:justify-between md:flex-row">
    <div class="py-4 flex flex-row items-center justify-between">
      <button class="md:hidden rounded-lg focus:outline-none focus:shadow-outline" @click="mobileMenu = !mobileMenu">
        <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">
          <path x-show="!mobileMenu" fill-rule="evenodd"
            d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z"
            clip-rule="evenodd"></path>
          <path x-show="mobileMenu" fill-rule="evenodd"
            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
            clip-rule="evenodd"></path>
        </svg>
      </button>
      <a href="{{ route('dashboard') }}"
        class="text-lg font-semibold tracking-widest text-gray-900 uppercase rounded-lg focus:outline-none focus:shadow-outline">
        <img src="/images/main/logo.svg" alt="Logo" class="h-9 md:h-12 mr-2">
      </a>
      <div class="block md:hidden">
        <button @click="userMenu = !userMenu" class="focus:outline-none active:outline-none">
          <img src="/images/auth/admin.png" alt="user" class="rounded-full h-7 w-7">
        </button>
        <div x-show="userMenu" @click="userMenu = false" class="fixed inset-0 h-full w-full z-10"></div>
        <ul x-show="userMenu" class="origin-top-right right-2 absolute bg-white rounded-md shadow z-20">
          <li class="">
            <a href="{{ route('admin.archive') }}"
              class="hover:bg-empex-green rounded hover:text-white py-2 px-4 block whitespace-no-wrap">Archive</a>
          </li>
          <li class="">
            <form action="{{ Route('admin.logout') }}" method="post">
              @csrf
              <button type="submit"
                class="hover:bg-empex-green rounded hover:text-white py-2 px-4 block whitespace-no-wrap">Logout</button>
            </form>
          </li>
        </ul>
      </div>
    </div>

    @include('layouts.admin-nav')
  </div>
</div>