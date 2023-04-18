<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="flex flex-row justify-between">

        <div class="py-12 min-w-max">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="mt-3 block w-full text-gray-900 dark:text-gray-100 text-center">Users</div>
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        @foreach ($users as $user)
                            <a href="{{ route('room.index', ['user_id' => $user->id]) }}"
                                class="transition block p-3 w-full text-gray-900 dark:text-gray-100 hover:bg-slate-700 cursor-pointer">
                                <div class="w-full">{{ $user->name }}</div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="py-12 w-full">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        {{ __("You're logged in!") }}

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
