<nav class="bg-white border-gray-200 py-2.5 dark:bg-gray-900 shadow-md">
    <div class="flex flex-wrap items-center justify-between max-w-screen-xl px-4 mx-auto">
        <a href="{{ route('home') }}" class="flex items-center">
            <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">{{ __('header.app_name') }}</span>
        </a>
                <!-- Navigation Links -->
            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                <x-nav-link :href="route('tasks.index')" :active="request()->routeIs('tasks.index')">
                    {{ __('header.tasks') }}
                </x-nav-link>
                <x-nav-link :href="route('task_statuses.index')" :active="request()->routeIs('task_statuses.index')">
                    {{ __('header.statuses') }}
                </x-nav-link>
                <x-nav-link :href="route('labels.index')" :active="request()->routeIs('labels.index')">
                    {{ __('header.labels') }}
                </x-nav-link>
            </div>

            <div class="flex items-center lg:order-2">
                @auth
                <form method="POST" 
                    action="{{ route('logout') }}"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2">
                    @csrf
                    <button type="submit">{{ __('header.logout') }}</button>
                </form>
                @else
                    <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        {{ __('header.login') }}
                    </a>
                    <a href="{{ route('register') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2">
                        {{ __('header.register') }}
                    </a>
                @endauth
            </div>
    </div>
</nav>
