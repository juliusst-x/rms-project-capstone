@extends('layouts.admin')

@section('title')
Edit House Data
@endsection

@section('content')
<main class="h-full pb-16 overflow-y-auto">
	<div class="container px-6 mx-auto grid">
		<h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
			Edit House Data
		</h2>
		<div class="my-4 mb-6">
			<a href="{{ route('house.view')}} "
				class="px-5 py-3  font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
				Back
			</a>
		</div>


		<form action="{{ route('house.update', $house->id) }}" method="POST" enctype="multipart/form-data">
			@csrf
			@method('PUT')
			<div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
				<label class="block mt-4 text-sm">
					<span class="text-gray-700 dark:text-gray-400">Name</span>
					<select
						class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-red-400 focus:outline-none focus:shadow-outline-red dark:focus:shadow-outline-gray"
						name="user_id" required>
						<option disabled selected>Select Resident Name</option>
						@foreach($users as $userId => $userName)
						<option value="{{ $userId }}" @if($userName == $house->user->name)
							selected
							@endif
							>{{ $userName }}</option>
						@endforeach
					</select>
					@error('user_id')
					<span class="text-red-600 dark:text-red-600">{{ $message }}</span>
					@enderror
				</label>

				<label class="block mt-4 text-sm">
					<span class="text-gray-700 dark:text-gray-400">Address</span>
					<input
						class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-red-400 focus:outline-none focus:shadow-outline-red dark:focus:shadow-outline-gray"
						type="text" placeholder="Cikarang" value="{{ $house->address }}" name="address">
					@error('address')
					<span class="text-red-600 dark:text-red-600">{{ $message }}</span>
					@enderror
				</label>

				<label class="block mt-4 text-sm">
					<span class="text-gray-700 dark:text-gray-400">Area</span>
					<select
						class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-red-400 focus:outline-none focus:shadow-outline-red dark:focus:shadow-outline-gray"
						name="area_id">
						<option value="" disabled>Select an area</option>
						@foreach($areas as $areaId => $areaName)
						<option value="{{ $areaId }}" {{ $areaId == $house->area_id ? 'selected' : '' }}>{{ $areaName }}
						</option>
						@endforeach
					</select>
					@error('area_id')
					<span class="text-red-600 dark:text-red-600">{{ $message }}</span>
					@enderror
				</label>

				<button type="submit"
					class="mt-4 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
					Update Resident House
				</button>
			</div>
		</form>
	</div>
</main>
@endsection