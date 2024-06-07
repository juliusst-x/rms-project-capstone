@extends('layouts.admin')

@section('title')
Officer Data
@endsection

@section('content')
<main class="h-full pb-16 overflow-y-auto">
    <div class="container grid px-6 mx-auto">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Officer Data
        </h2>

        <div class="my-4 mb-6">
            <a href="{{ route('staff.create') }}"
                class="px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
                Add Officer
            </a>
        </div>
        <div class="w-full mb-8 overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">No</th>
                            <th class="px-4 py-3">Name</th>
                            <th class="px-4 py-3">Phone Number</th>
                            <th class="px-4 py-3">Email</th>
                            <th class="px-4 py-3">Role</th>
                            <th class="px-4 py-3">Action</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @forelse ($data as $staff)
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td class="px-4 py-3 text-sm">
                                {{ $loop->iteration }}
                            </td>

                            <td class="px-4 py-3 text-sm">
                                {{ $staff->name }}
                            </td>

                            <td class="px-4 py-3 text-sm">
                                {{ $staff->phone }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $staff->email }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $staff->level }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <a href="{{ route('staff.edit', $staff->identifiers) }}"
                                    class="bg-blue-500 hover:bg-blue-500 text-white font-bold py-2 px-4 rounded inline-block w-full sm:w-auto">Edit</a>

                                <button onclick="confirmDelete('{{ $staff->identifiers }}')" 
                                    class="bg-red-600 hover:bg-red-600 text-white font-bold py-2 px-4 rounded w-full sm:w-auto">
                                    Delete
                                </button>

                                <form id="delete-form-{{ $staff->identifiers }}" action="{{ route('staff.delete', $staff->identifiers) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-gray-400">
                                Empty Data
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<!-- Include SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(identifier) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + identifier).submit();
            }
        })
    }
</script>
@endsection
