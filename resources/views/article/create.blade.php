<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $article ? __('Article / Edit') : __('Article / Create') }}
            </h2>
            <a href="{{ route('articles.index') }}" class="bg-slate-700 text-sm rounded-md text-white px-3 py-1">
                Back
            </a>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ $article ? route('articles.update', $article->id) : route('articles.store') }}"
                        method="post">
                        @csrf
                        @if ($article)
                            @method('PUT')
                        @endif
                        <div>
                            <label for="title" class="text-lg font-medium">Title</label>
                            <div class="my-3">
                                <input name="title" value="{{ old('title', $article->title ?? '') }}" id="title"
                                    placeholder="Enter Title" type="text"
                                    class="border-gray-300 text-black shadow-sm w-1/2 rounded-lg">
                                @error('title')
                                <p class="text-red-400 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                            <label for="title" class="text-lg font-medium">Text</label>
                            <div class="my-3">
                                <textarea name="text" id="text" placeholder="Enter Text"
                                    class="border-gray-300 text-black shadow-sm w-1/2 rounded-lg">{{ old('text', $article->text ?? '') }}</textarea>
                            </div>
                            <label for="title" class="text-lg font-medium">Author</label>
                            <div class="my-3">
                                <input name="author" value="{{ old('author', $article->author ?? '') }}" id="author"
                                    placeholder="Enter Author" type="text"
                                    class="border-gray-300 text-black shadow-sm w-1/2 rounded-lg">
                            </div>
                            <button class="bg-slate-700 text-sm rounded-md text-white px-5 py-3">
                                {{ $article ? 'Update' : 'Submit' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
