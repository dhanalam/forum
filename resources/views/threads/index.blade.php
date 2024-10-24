<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Forum Threads') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-10 text-gray-900 dark:text-gray-100">
                    <ul class="list-disc">
                        @foreach($threads as $thread)
                            <li class="article mb-6">
                                <h3 class="text-xl mb-2">
                                    <a href="{{ $thread->path }}" class="text-link">{{ $thread->title }}</a>
                                </h3>
                                <div class="body text-sm">{{ $thread->body }}</div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
