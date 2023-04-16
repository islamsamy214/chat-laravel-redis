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
                        @foreach ($messages as $message)
                            <div class="flex flex-row justify-between">
                                <div class="flex flex-row">
                                    <div class="w-10 h-10 rounded-full bg-gray-300 mr-3"></div>
                                    <div class="flex flex-col">
                                        <div class="font-bold">{{ $message->user->name }}</div>
                                        <div class="text-sm">{{ $message->created_at }}</div>
                                    </div>
                                </div>
                                <div class="flex flex-col">
                                    <div class="text-sm">{{ $message->message }}</div>
                                </div>
                            </div>
                        @endforeach

                        {{-- form to send message --}}
                        <form action="{{ route('room.store') }}" method="POST">
                            @csrf
                            <div class="flex flex-row justify-between">
                                <div class="flex flex-row">
                                    <div class="w-10 h-10 rounded-full bg-gray-300 mr-3"></div>
                                    <div class="flex flex-col">
                                        <div class="font-bold">{{ Auth::user()->name }}</div>
                                        <div class="text-sm">{{ now() }}</div>
                                    </div>
                                </div>
                                <div class="flex flex-col">
                                    <div class="text-sm">
                                        <input type="text" name="message" id="message" class="w-full">
                                        <input type="hidden" name="user_id" id="user_id"
                                            value="{{ Auth::user()->id }}">
                                        <input type="hidden" name="room_id" id="room_id"
                                            value="{{ $message->room_id }}">
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-row justify-end">
                                <button type="submit"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Send
                                </button>
                            </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="py-12 min-w-max">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="mt-3 block w-full text-gray-900 dark:text-gray-100 text-center">Rooms</div>
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        @foreach ($rooms as $room)
                            <a href="{{ route('room.index', ['room_id' => $room->id]) }}"
                                class="transition block p-3 w-full text-gray-900 dark:text-gray-100 hover:bg-slate-700 cursor-pointer">
                                <div class="w-full">{{ $room->name }}</div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</x-app-layout>
