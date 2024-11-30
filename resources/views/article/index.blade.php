<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Articles / List') }}
            </h2>
            <a href="{{ route('articles.create') }}" class="bg-slate-700 text-sm rounded-md text-white px-3 py-3">
                Create
            </a>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="max-w-7x1 mx-auto sm:px-6 lg:px-8">
                {{-- massage --}}
                <x-massage></x-massage>
                <table class="w-full text-white">
                    <thead class="bg-slate-700 border border-slate-700">
                        <tr class="border-b">
                            <th class="px-6 py-3 text-left">#</th>
                            <th class="px-6 py-3 text-left">Author</th>
                            <th class="px-6 py-3 text-left">creator name</th>

                            <th class="px-6 py-3 text-left">Article</th>
                            <th class="px-6 py-3 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="">
                        @if ($articles->isNotEmpty())
                            @foreach ($articles as $article)
                                <tr class="border-b border-slate-700">
                                    <td class="px-6 py-3 text-left"> {{ $article->id }} </td>
                                    <td class="px-6 py-3 text-left"> {{ $article->author }} </td>
                                    <td class="px-6 py-3 text-left"> {{ $article->user->name }} </td>
                                    <td class="px-6 py-3 text-left">
                                       <span class="font-bold"> {{ $article->title }} </span> <br>
                                        {{ $article->text }}
                                     </td>
                                    <td class="px-6 py-3 text-center">
                                        <a href="{{ route('articles.edit', $article->id) }}"
                                            class="bg-slate-700 text-sm rounded-md text-white px-3 mx-2 py-2 hover:bg-slate-600">
                                            Edit
                                        </a>
                                        <form action="{{ route('articles.destroy', $article->id) }}" method="POST"
                                            class="inline-block"
                                            onsubmit="return confirm('Are you sure you want to delete this article?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-600 text-sm rounded-md text-white px-3 py-2 hover:bg-red-500">
                                                Delete
                                            </button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                {{ $articles->links() }}
            </div>
        </div>
</x-app-layout>
