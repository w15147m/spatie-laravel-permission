<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $user ? __('user    / Edit') : __('user / Create') }}
            </h2>
            <a href="{{ route('user.index') }}" class="bg-slate-700 text-sm rounded-md text-white px-3 py-1">
                Back
            </a>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form newuser {{ $user }}
                        action="{{ $user ? route('user.update', $user->id) : route('user.store') }}" method="post">
                        @csrf
                        @if ($user)
                            @method('PUT')
                        @endif
                        <div>
                            <label for="name" class="text-lg font-medium">Name</label>
                            <div class="my-3">
                                <input name="name" value="{{ old('name', $user->name ?? '') }}" id="name"
                                    placeholder="Enter Name" type="text"
                                    class="border-gray-300 text-black shadow-sm w-1/2 rounded-lg">
                                @error('name')
                                    <p class="text-red-400 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="my-3">
                                <input name="email" value="{{ old('email', $user->email ?? '') }}" id="email"
                                    placeholder="Enter email" type="text"
                                    class="border-gray-300 text-black shadow-sm w-1/2 rounded-lg">
                                @error('email')
                                    <p class="text-red-400 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="grid grid-cols-4 mb-3">
                                @if ($roles->isNotEmpty())
                                    @foreach ($roles as $role)
                                        <div class="mt-3">
                                            <input type="checkbox"
                                                {{ $hasRoles && $hasRoles->contains($role->id) ? 'checked' : '' }}
                                                id="role-{{ $role->id }}" class="rounded" name="roles[]"
                                                value="{{ $role->name }}">
                                            <label for="role-{{ $role->id }}">
                                                {{ $role->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <button class="bg-slate-700 text-sm rounded-md text-white px-5 py-3">
                                {{ $user ? 'Update' : 'Submit' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
