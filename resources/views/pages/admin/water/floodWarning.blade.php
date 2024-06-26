@extends('layouts.masyarakat')

@section('title', 'Flood Warning')

@section('content')
<main class="h-full pb-16 overflow-y-auto">
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-center text-gray-700 dark:text-gray-200">Flood Monitoring</h2>
    </div>

    <div class="container grid px-6 mx-auto">
        <div class="w-full mb-8 overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap" id="test">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">Area Name</th>
                            <th class="px-4 py-3">Water Level</th>
                            <th class="px-4 py-3">Threshold</th>
                            <th class="px-4 py-3">Status</th>
                            {{-- <th class="px-4 py-3">Action</th> --}}
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @foreach ($waterLevels as $waterLevel)
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3 text-sm">
                                    {{ $waterLevel->area->area_name }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <span id="water_level">{{ $waterLevel->water_level }}</span>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $waterLevel->threshold}}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $waterLevel->status}}
                                </td>
                                {{-- <td class="px-4 py-3 text-sm">
                                    <form action="" method="POST">
                                        <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                    </form>
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        setInterval(() => {
            $.ajax({
                url: "{{ route('water.data') }}",
                type: "GET",
                success: function(response) {
                    console.log(response);
                    $('tbody').empty(); // Clear existing rows
                    $.each(response.waterLevels, function(index, water) {
                        $('tbody').append(
                            `<tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3 text-sm">${water.area.area_name}</td>
                                <td class="px-4 py-3 text-sm">${water.water_level}</td>
                                <td class="px-4 py-3 text-sm">${water.threshold}</td>
                                <td class="px-4 py-3 text-sm">${water.status}</td>

                            </tr>`
                        );
                    });
                }
            });
        }, 1000); // Update interval in milliseconds
    });
</script>
@endsection