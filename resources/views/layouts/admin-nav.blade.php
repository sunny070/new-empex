<nav :class="{'flex': mobileMenu, 'hidden': !mobileMenu}"
  class="flex-col flex-grow pb-4 md:pb-0 hidden md:flex md:justify-end md:flex-row {{ auth()->check() && request()->is('jobs') ? 'mt-4' : '' }}">
  <div class="md:hidden">
    @livewire('admin.sidebar')
  </div>

  <div class="md:flex flex-row hidden">
    <div class="flex flex-col">
      <p class="text-lg no-underline text-grey-darkest hover:text-blue-dark">Hello! {{ Auth::user()->name }}</p>
    </div>
    <div class="flex flex-col ml-2">
      <div class="dropdown inline-block relative">
        <button @click="userMenu = !userMenu" class="focus:outline-none active:outline-none">
          <img src="/images/auth/admin.png" alt="admin" class="rounded-full h-7 w-7">
        </button>
        <div x-show="userMenu" @click="userMenu = false" class="fixed inset-0 h-full w-full z-10"></div>
        <ul x-show="userMenu" class="origin-top-right right-0 absolute bg-white rounded-md shadow z-20">
          <li class="">
            <a class="rounded-t hover:bg-empex-green hover:text-white py-2 px-4 block whitespace-no-wrap"
              href="{{ Route('admin.archive') }}">Archive</a>
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
  </div>
</nav>
