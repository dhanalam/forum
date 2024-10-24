<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $thread->creator->name }} Posted: <span class="italic mr-2">"{{ $thread->title }}"</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-10 text-gray-900 dark:text-gray-100">
                    <p class="text-gray-800 dark:text-gray-200">
                        {{ $thread->body }}
                    </p>

                    @if($thread->replies->count() > 0)
                        <div class="mt-10 text-gray-900 dark:text-gray-100">
                            <h3 class="text-xl mb-4">Replies</h3>
                            <div class="list-disc">
                                @foreach($thread->replies as $reply)
                                    <div class="mb-3">
                                        <div>
                                            <div class="text-left">
                                                <span class="italic">"{{ $reply->owner->name }}"</span> said {{ $reply->created_at->diffForHumans() }}
                                            </div>
                                            <blockquote class="text-gray-900 dark:text-white">
                                                <p>{{ $reply->body }}</p>
                                            </blockquote>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @auth()
                        <div class="mt-10">
                            <form action="{{ $thread->path.'/replies' }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="message"
                                           class="block mb-2 text-lg font-medium text-gray-900 dark:text-white"
                                    >Reply !!!</label>
                                    <textarea id="message"
                                              rows="5"
                                              name="body"
                                              class="form-control"
                                              placeholder="Have something to say?"
                                    ></textarea>
                                </div>
                                <button type="submit"
                                        class="btn-primary"
                                >Reply</button>
                            </form>
                        </div>
                    @else
                        <p class="text-center mt-8">Please <a href="/login" class="text-link">sign in</a> to participate in this discussion</p>
                    @endauth


                </div>
            </div>
        </div>
    </div>



</x-app-layout>
