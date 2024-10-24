<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create a new thread') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-10 text-gray-900 dark:text-gray-100">

                    <x-validation-error/>

                    <form action="/threads" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="channel_id" class="form-label">Channel</label>
                            <x-input-select name="channel_id"
                                            placeholder="Choose channel"
                                            id="channel_id"
                                            required
                                            selected="{{ old('channel_id') }}"
                                            :options="$channels->toArray()"
                            />
                        </div>


                        <div class="form-group">
                            <label for="title" class="form-label">Title</label>
                            <x-text-input
                                id="title"
                                name="title"
                                placeholder="Enter title"
                                value="{{ old('title') }}"
                                required
                            />
                        </div>
                        <div class="form-group">
                            <label for="body" class="form-label">Description</label>
                            <x-input-textarea
                                id="body"
                                name="body"
                                placeholder="Write a description"
                                :value="old('body')"
                                required
                            />
                        </div>
                        <button type="submit" class="btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



</x-app-layout>
