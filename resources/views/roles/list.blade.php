<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('roles/List') }}
            </h2>
            <a href="{{ route('role.create') }}" class="bg-slate-700 text-sm rounded-md text-white px-3 py-3">
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
                        @if ($roles->isNotEmpty())
                            @foreach ($roles as $role)
                                <tr class="border-b border-slate-700">
                                    <td class="px-6 py-3 text-left"> {{ $role->id }} </td>
                                    <td class="px-6 py-3 text-left"> {{ $role->name }} </td>
                                    <td class="px-6 py-3 text-left"> {{ $role->created_at }} </td>
                                    <td class="px-6 py-3 text-center">
                                        <a href="{{ route('role.edit', $role->id) }}"
                                            class="bg-slate-700 text-sm rounded-md text-white px-3 mx-2 py-2 hover:bg-slate-600">
                                            Edit
                                        </a>
                                        <form action="{{ route('role.delete', $role->id) }}" method="POST" class="inline-block"
                                            onsubmit="return confirm('Are you sure you want to delete this role?')">
                                          @csrf
                                          @method('DELETE')
                                          <button type="submit" class="bg-red-600 text-sm rounded-md text-white px-3 py-2 hover:bg-red-500">
                                              Delete
                                          </button>
                                      </form>
                                      
                                    </td>
                                </tr>
                                </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                {{$roles->links() }}
            </div>
        </div>
</x-app-layout>
