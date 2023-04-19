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
                        {{-- form to send message --}}
                        <form id="send-form" action="#" method="POST">
                            @csrf
                            <div class="flex flex-row justify-between">
                                <div class="flex flex-row">
                                    <div class="w-10 h-10 rounded-full bg-gray-300 mr-3"></div>
                                    <div class="flex flex-col">
                                        <div class="font-bold">{{ Auth::user()->name }}</div>
                                        <div class="text-sm">{{ now() }}</div>
                                    </div>
                                </div>
                                <div class="flex flex-col w-full px-4">
                                    <div class="text-sm">
                                        <textarea name="message" id="message" class="w-full dark:bg-gray-800 hover:border-slate-700 focus:border-slate-700"></textarea>
                                        @isset($room_id)
                                            <input type="hidden" name="room_id" id="room_id" value="{{ $room_id }}">
                                        @endisset
                                        @isset($user_id)
                                            <input type="hidden" name="user_id" id="user_id" value="{{ $user_id }}">
                                        @endisset
                                        <small class="text-red-600"
                                            id="error">{{ $errors->first('message') }}</small>
                                    </div>
                                </div>
                                <div class="flex flex-row justify-end">
                                    <button type="submit"
                                        class="bg-slate-900 hover:bg-slate-700 text-white font-bold py-2 px-4 rounded">
                                        Send
                                    </button>
                                </div>
                            </div>
                        </form>
                        <hr class="my-4" id="message-line" />
                        {{-- messages --}}
                        @foreach ($messages as $message)
                            <div class="flex flex-row justify-between mt-3">
                                <div class="flex flex-row">
                                    <div class="w-10 h-10 rounded-full bg-gray-300 mr-3"></div>
                                    <div class="flex flex-col">
                                        <div class="font-bold">{{ $message->user->name }}</div>
                                    </div>
                                </div>
                                <div class="flex flex-col">
                                    <div class="text-sm">{{ $message->message }}</div>
                                    <div class="text-sm text-end">{{ $message->created_at }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    $ajaxForm = $('#send-form');
    $ajaxForm.submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '{{ route('room.store') }}',
            data: $ajaxForm.serialize(),
            success: function(response) {
                console.log(response);
            },
            error: function(error) {
                $('#error').text(error.responseJSON.message);
            }
        });
    });
</script>
