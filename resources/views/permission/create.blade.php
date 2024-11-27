<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $permission ? __('permission / Edit') : __('permission / Create') }}
            </h2>
            <a href="{{ route('permission.index') }}" class="bg-slate-700 text-sm rounded-md text-white px-3 py-1">
                Back
            </a>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form
                        action="{{ $permission ? route('permission.update', $permission->id) : route('permission.store') }}"
                        method="post">
                        @csrf
                        @if ($permission)
                            @method('PUT')
                        @endif
                        <div>
                            <label for="name" class="text-lg font-medium">Name</label>
                            <div class="my-3">
                                <input name="name" value="{{ old('name', $permission->name ?? '') }}" id="name"
                                    placeholder="Enter Name" type="text"
                                    class="border-gray-300 text-black shadow-sm w-1/2 rounded-lg">
                                @error('name')
                                    <p class="text-red-400 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                            <button class="bg-slate-700 text-sm rounded-md text-white px-5 py-3">
                                {{ $permission ? 'Update' : 'Submit' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
