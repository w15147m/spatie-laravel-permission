<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('permissions/List') }}
            </h2>
            <a href="{{ route('permission.create') }}" class="bg-slate-700 text-sm rounded-md text-white px-3 py-3">
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
                            <th class="px-6 py-3 text-left">Name</th>
                            <th class="px-6 py-3 text-left">Created</th>
                            <th class="px-6 py-3 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="">
                        @if ($permissions->isNotEmpty())
                            @foreach ($permissions as $permission)
                                <tr class="border-b border-slate-700">
                                    <td class="px-6 py-3 text-left"> {{ $permission->id }} </td>
                                    <td class="px-6 py-3 text-left"> {{ $permission->name }} </td>
                                    <td class="px-6 py-3 text-left"> {{ $permission->created_at }} </td>
                                    <td class="px-6 py-3 text-center">
                                        <a href="#"
                                            class="bg-slate-700 text-sm rounded-md text-white px-3 mx-2 py-2 hover:bg-slate-600">
                                            Edit
                                        </a>
                                        <a href="#"
                                            class="bg-red-600 text-sm rounded-md text-white px-3 py-2 hover:bg-red-500">
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                                </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
</x-app-layout>
