@extends('layouts.admin')

@section('title', 'Flood Warning')

@section('content')
<main class="h-full pb-16 overflow-y-auto">
	<div class="container px-6 mx-auto grid">
		<h2 class="my-6 text-2xl font-semibold text-center text-gray-700 dark:text-gray-200">Flood Monitoring</h2>

		<div class="my-4 mb-6">
			<a href="{{ route('water.create') }}"
				class="px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
				Add Water Detector
			</a>
		</div>

	</div>
	<div class="container grid px-6 mx-auto">
		<div class="w-full mb-8 overflow-hidden rounded-lg shadow-xs">
			<div class="w-full overflow-x-auto">
				<table class="w-full whitespace-no-wrap">
					<thead>
						<tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
							<th class="px-4 py-3">Area Name</th>
							<th class="px-4 py-3">Water Level</th>
							<th class="px-4 py-3">Threshold</th>
							<th class="px-4 py-3">Status</th>
							<th class="px-4 py-3">Action</th>
						</tr>
					</thead>
					<tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
						@foreach ($waterLevels as $waterLevel)
						<tr class="text-gray-700 dark:text-gray-400">
							<td class="px-4 py-3 text-sm">
								{{ $waterLevel->area->area_name }}
							</td>
							<td class="px-4 py-3 text-sm" id="water">
								{{ $waterLevel->water_level }}
							</td>
							<td class="px-4 py-3 text-sm">
								{{ $waterLevel->threshold }}
							</td>
							<td class="px-4 py-3 text-sm" id="status">
								{{ $waterLevel->status}}
							</td>
							<td class="px-4 py-3 text-sm">
								<!-- <form action="" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');">                                                                                                                                                  <button type="submit" class="text-red-600 hover:text-red-900">Delete</button                                                                                                                                   </form> -->
								<a href="{{ route('water.edit.page', $waterLevel->identifiers) }}" class="bg-blue-600 hover:bg-blue-900 text-white font-bold py-2 px-4 rounded">Edit</a>
								<button onclick="confirmDelete('{{ $waterLevel->identifiers }}')" class="bg-red-600 hover:bg-red-600 text-white font-bold py-2 px-4 rounded w-full sm:w-auto">
									Delete
								</button>
								<form id="delete-form-{{ $waterLevel->identifiers }}" action="{{ route('water.delete', $waterLevel->identifiers) }}" method="POST" style="display: none;">
									@csrf
									@method('DELETE')
								</form>
							</td>
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
								<td class="px-4 py-3 text-sm">
                                    <a href="/admin/water/edit/${water.identifiers}"
                                        class="bg-blue-600 hover:bg-blue-900 text-white font-bold py-2 px-4 rounded">Edit</a>
                                    <button onclick="confirmDelete('${water.identifiers}')"
                                        class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded w-full sm:w-auto">
                                        Delete
                                    </button>
                                    <form id="delete-form-${water.identifiers}" action="/admin/water/delete/${water.identifiers}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>`
						);
					});
				}
			});
		}, 1000); // Update interval in milliseconds
	});
</script>

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