@extends('layouts.admin')

@section('title')
Area
@endsection

@section('content')
<main class="h-full pb-16 overflow-y-auto">
	<div class="container grid px-6 mx-auto">
		<h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
			Residence Area Data
		</h2>

		<div class="my-4 mb-6">
			<a href="{{ route('area.create')}} "
				class="px-5 py-3  font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
				Add Residence Area
			</a>
		</div>
		<div class="w-full mb-8 overflow-hidden rounded-lg shadow-xs">
			<div class="w-full overflow-x-auto">
				@if ($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach($errors->all() as $error)
						<li>{{ $error }} </li>
						@endforeach
					</ul>
				</div>
				@endif
				<table class="w-full whitespace-no-wrap">
					<thead>
						<tr class="text-center font-semibold tracking-wide text-left text-gray-500 uppercase border-b
                            dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800 justify-center">
							<th class="px-4 py-3">Area Name</th>
							<th class="px-4 py-3">Description</th>
							<th class="px-4 py-3">Action</th>
						</tr>
					</thead>
					<tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
						@forelse ($items as $area)
						<tr class="text-center text-gray-700 dark:text-gray-400">
							<td class="px-4 py-3 ">
								{{ $area->area_name }}
							</td>
							<td class="px-4 py-3 ">
								{{ $area->description }}
							</td>

							<td class="px-4 py-3 flex items-center justify-center space-x-3">
								<a href="{{ route('area.edit', $area->identifiers) }}" class="bg-blue-600 hover:bg-blue-900 text-white
                                            font-bold py-2 px-4 rounded">Edit</a>
								<form action="{{ route('area.delete', $area->id) }}" method="POST">
									@csrf
									@method('DELETE')
									<button type="submit" class="bg-red-600 hover:bg-red-900 text-white
                                            font-bold py-2 px-4 rounded">Delete</button>
								</form>
							</td>

						</tr>
						@empty
						<tr>
							<td colspan="7" class="text-center text-gray-400">
								No Data
							</td>
						</tr>
						@endforelse
					</tbody>
				</table>
			</div>

		</div>

	</div>
</main>
@endsection