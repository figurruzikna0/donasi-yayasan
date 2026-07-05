@php $navUser = Auth::user(); @endphp
@if(!$navUser || $navUser->role !== 'admin')
<nav x-data="{ open: false }" class="bg-base-100 border-b border-base-200">
    <div class="navbar max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 min-h-[4rem]">
        <div class="flex-1 flex items-center gap-4">
            <a href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : route('dashboard') }}" class="shrink-0">
                <x-application-logo class="block h-9 w-auto fill-current text-base-content" />
            </a>
            <div class="hidden sm:flex gap-1">
                <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                    Dashboard
                </x-nav-link>
            </div>
        </div>

        <div class="flex-none hidden sm:flex">
            <div class="dropdown dropdown-end">
                <button tabindex="0" class="btn btn-ghost btn-sm gap-2">
                    <div>{{ Auth::user()->name }}</div>
                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
                <ul tabindex="0" class="dropdown-content menu bg-base-100 rounded-box z-[1] w-52 p-2 shadow-lg">
                    <li><a :href="route('profile.edit')" onclick="event.preventDefault(); window.location.href='{{ route('profile.edit') }}'">Profile</a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}" class="p-0">
                            @csrf
                            <button type="submit" class="w-full text-left">Log Out</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>

        <div class="flex-none sm:hidden">
            <button @click="open = ! open" class="btn btn-ghost btn-square">
                <svg x-show="!open" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg x-show="open" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>

    <div x-show="open" class="sm:hidden bg-base-100 border-t border-base-200">
        <ul class="menu menu-md p-4 pt-2">
            <li><a :href="route('dashboard')" wire:navigate>Dashboard</a></li>
            <li class="menu-title text-xs"><span>Akun</span></li>
            <li><a :href="route('profile.edit')" wire:navigate>Profile</a></li>
            <li>
                <form method="POST" action="{{ route('logout') }}" class="p-0">
                    @csrf
                    <button type="submit" class="w-full text-left">Log Out</button>
                </form>
            </li>
        </ul>
    </div>
</nav>
@endif
