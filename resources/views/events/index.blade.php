<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            @can(Auth::guard('admin')->check())
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Events') }}
            </h2>
            @endcan
            @if(Auth::guard('admin')->check())
                <div>
                    <a href="{{ route('events.create') }}" class="dark:text-white hover:text-slate-200">New Event</a>
                </div>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-lg text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Title
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Start Date
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Province
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                        <tbody>
                            @forelse($events as $event)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $event->title }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $event->start_date }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $event->province->name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex space-x-2">
                                            @if(Auth::guard('admin')->check())
                                                <a href="{{ route('events.edit', $event) }}" class="text-green-400 hover:text-green-600">Edit</a>
                                                <form method="POST" class="text-red-400 hover:text-red-600" id="del_form_{{ $event->id }}"
                                                    action="{{ route('events.destroy', $event) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" id="del_btn_{{ $event->id }}" onclick="confirmDelete({{ $event->id }})" class="text-red-400 hover:text-red-600">
                                                        Delete
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                        No events found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(eventId) {
            const form = document.getElementById(`del_form_${eventId}`);
    
            Swal.fire({
                title: "Confirm to delete",
                text: "Are you sure?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Confirm!"
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
    </script>
</x-app-layout>