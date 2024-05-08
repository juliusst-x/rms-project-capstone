@extends('layouts.admin')

@section('title')
Edit Residence Area
@endsection

@section('content')
<main class="h-full pb-16 overflow-y-auto">
	<div class="container grid px-6 mx-auto">
		<h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
			Edit Residence Area
		</h2>

		<div class="my-4 mb-6">
			<a href="{{ route('area.view')}} "
				class="px-5 py-3  font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
				Back
			</a>
		</div>

		<form action="{{ route('area.update', $area->identifiers) }}" method="POST">
			@csrf
			@method('PUT')
			<div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
				<label class="block mt-4 text-sm">
					<span class="text-gray-700 dark:text-gray-400">Name</span>
					<input
						class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-red-400 focus:outline-none focus:shadow-outline-red dark:focus:shadow-outline-gray"
						type="text" placeholder="Area Name" value="{{ $area->area_name }}" name="area_name">
					@error('area_name')
					<span class="text-red-600 dark:text-red-600">{{ $message }}</span>
					@enderror
				</label>
				<label class="block mt-4 text-sm">
					<span class="text-gray-700 dark:text-gray-400">Description</span>
					<textarea
						class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-red-400 focus:outline-none focus:shadow-outline-red dark:focus:shadow-outline-gray"
						rows="2" cols="2" placeholder="Description" name="description"
						id="description">{{$area->description}}</textarea>
					@error('description')
					<span class="text-red-600 dark:text-red-600">{{ $message }}</span>
					@enderror
				</label>

				<button type="submit"
					class="mt-4 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
					Update Residence Area
				</button>
			</div>


	</div>
	</form>
	</div>
	</div>
	</div>
</main>
@endsection