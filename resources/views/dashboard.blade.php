<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-bold mb-4">Articles</h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($articles as $article)
                            <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow">
                                <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-2">
                                    {{ $article->title }}
                                </h4>
                                <p class="text-gray-600 dark:text-gray-400 text-sm mb-3">
                                    {{ Str::limit($article->text, 100) }}
                                </p>
                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                    <p>Author: <span class="font-medium">{{ $article->author }}</span></p>
                                    <p>Created: {{ $article->created_at->format('F j, Y') }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-6">
                        {{ $articles->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
