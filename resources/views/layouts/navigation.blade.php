<nav x-data="{ open: false }" class="bg-white border-b border-slate-200 sticky top-0 z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center gap-6">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5">
                        <div class="w-9 h-9 rounded-xl bg-teal-700 text-white flex items-center justify-center font-bold text-lg">
                            S
                        </div>
                        <span class="font-bold text-slate-800 text-lg tracking-tight">SmartCare <span class="text-teal-700">HMS</span></span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-1.5 sm:flex sm:items-center">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('ទំព័រដើម') }}
                    </x-nav-link>

                    <x-nav-link :href="route('patients.index')" :active="request()->routeIs('patients.*')">
                        {{ __('អ្នកជំងឺ') }}
                    </x-nav-link>

                    <x-nav-link :href="route('handovers.index')" :active="request()->routeIs('handovers.*')">
                        {{ __('ប្រគល់វេន') }}
                    </x-nav-link>

                    <x-nav-link :href="route('medical-records.index')" :active="request()->routeIs('medical-records.*')">
                        {{ __('OPD / ពិគ្រោះ') }}
                    </x-nav-link>

                    <x-nav-link :href="route('surgeries.index')" :active="request()->routeIs('surgeries.*')">
                        {{ __('ការវះកាត់') }}
                    </x-nav-link>

                    <x-nav-link :href="route('nursing-logs.index')" :active="request()->routeIs('nursing-logs.*')">
                        {{ __('ថែទាំ') }}
                    </x-nav-link>

                    <x-nav-link :href="route('equipments.index')" :active="request()->routeIs('equipments.*')">
                        {{ __('ER / ឧបករណ៍') }}
                    </x-nav-link>

                    <x-nav-link :href="route('invoices.index')" :active="request()->routeIs('invoices.*')">
                        {{ __('វិក្កយបត្រ') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-1.5 border border-transparent text-sm leading-4 font-semibold rounded-xl text-slate-700 bg-slate-100/80 hover:text-slate-900 hover:bg-slate-200/80 focus:outline-none transition ease-in-out duration-150 gap-2">
                            @if(Auth::user()->profile_photo)
                                <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" onerror="this.classList.add('hidden'); document.getElementById('nav-human-avatar').classList.remove('hidden');" alt="{{ Auth::user()->name }}" class="w-7 h-7 rounded-lg object-cover border border-teal-600 shrink-0">
                                <div id="nav-human-avatar" class="hidden w-7 h-7 rounded-lg bg-teal-50 text-teal-700 border border-teal-200 flex items-center justify-center shrink-0">
                                    <svg class="w-4 h-4 text-teal-700" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                    </svg>
                                </div>
                            @else
                                <div class="w-7 h-7 rounded-lg bg-teal-50 text-teal-700 border border-teal-200 flex items-center justify-center shrink-0">
                                    <svg class="w-4 h-4 text-teal-700" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                    </svg>
                                </div>
                            @endif
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-0.5">
                                <svg class="fill-current h-4 w-4 text-slate-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.show')">
                            {{ __('ព័ត៌មាន Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('ចាកចេញ') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-xl text-slate-400 hover:text-slate-500 hover:bg-slate-100 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'inline-flex': open, 'hidden': ! open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white border-b border-slate-100">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('ទំព័រដើម') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('patients.index')" :active="request()->routeIs('patients.*')">
                {{ __('អ្នកជំងឺ') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('handovers.index')" :active="request()->routeIs('handovers.*')">
                {{ __('ប្រគល់វេន') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('medical-records.index')" :active="request()->routeIs('medical-records.*')">
                {{ __('OPD / ពិគ្រោះ') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('surgeries.index')" :active="request()->routeIs('surgeries.*')">
                {{ __('ការវះកាត់') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('nursing-logs.index')" :active="request()->routeIs('nursing-logs.*')">
                {{ __('ថែទាំ') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('equipments.index')" :active="request()->routeIs('equipments.*')">
                {{ __('ER / ឧបករណ៍') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('invoices.index')" :active="request()->routeIs('invoices.*')">
                {{ __('វិក្កយបត្រ') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-1 border-t border-slate-100">
            <div class="px-4 flex items-center gap-3">
                @if(Auth::user()->profile_photo)
                    <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="{{ Auth::user()->name }}" class="w-10 h-10 rounded-xl object-cover border border-teal-600 shrink-0">
                @else
                    <div class="w-10 h-10 rounded-xl bg-teal-50 text-teal-700 border border-teal-200 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6 text-teal-700" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                        </svg>
                    </div>
                @endif
                <div>
                    <div class="font-medium text-base text-slate-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-slate-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.show')">
                    {{ __('ព័ត៌មាន Profile') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('ចាកចេញ') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
