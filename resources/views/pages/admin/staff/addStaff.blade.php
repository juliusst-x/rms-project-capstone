@extends('layouts.admin')

@section('title')
Office Data
@endsection

@section('content')
<main class="h-full pb-16 overflow-y-auto">
	<div class="container px-6 mx-auto grid">
		<h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
			Staff Registration Form
		</h2>

		<div class="my-4 mb-6">
			<a href="{{ route('staff.view')}} "
				class="px-5 py-3  font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
				Back
			</a>
		</div>

		<form action="{{ route('staff.store')}} " method="POST" enctype="multipart/form-data">
			@csrf
			<div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">

				<label class="block mt-4 text-sm">
					<span class="text-gray-700 dark:text-gray-400">Name</span>
					<input
						class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-red-400 focus:outline-none focus:shadow-outline-red dark:focus:shadow-outline-gray"
						type="text" placeholder="Name" value="{{ old('name')}}" name="name" required></input>
					@error('name')
					<span class="text-red-600 dark:text-red-600">{{ $message }}</span>
					@enderror
				</label>

				<label class="block mt-4 text-sm">
					<span class="text-gray-700 dark:text-gray-400">Email</span>
					<input
						class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-red-400 focus:outline-none focus:shadow-outline-red dark:focus:shadow-outline-gray"
						type="email" placeholder="Email" value="{{ old('email')}}" name="email" required></input>
					@error('email')
					<span class="text-red-600 dark:text-red-600">{{ $message }}</span>
					@enderror
				</label>

				<label class="block mt-4 text-sm">
					<span class="text-gray-700 dark:text-gray-400">Phone Number</span>
					<input
						class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-red-400 focus:outline-none focus:shadow-outline-red dark:focus:shadow-outline-gray"
						type="text" placeholder="Phone Number" value="{{ old('phone')}}" name="phone" required></input>
					@error('phone')
					<span class="text-red-600 dark:text-red-600">{{ $message }}</span>
					@enderror
				</label>

				<label class="block mt-4 text-sm">
					<span class="text-gray-700 dark:text-gray-400">Address</span>
					<input
						class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-red-400 focus:outline-none focus:shadow-outline-red dark:focus:shadow-outline-gray"
						type="text" required placeholder="Address" value="{{ old('address')}}" name="address"></input>
					@error('address')
					<span class="text-red-600 dark:text-red-600">{{ $message }}</span>
					@enderror
				</label>

				<label class="block mt-4 text-sm">
					<span class="text-gray-700 dark:text-gray-400">Password</span>
					<input
						class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-red-400 focus:outline-none focus:shadow-outline-red dark:focus:shadow-outline-gray"
						type="password" placeholder="Password" value="{{ old('password')}}" required
						name="password"></input>
				</label>

				<label class="block mt-4 text-sm">
					<span class="text-gray-700 dark:text-gray-400">Confirm password</span>
					<input
						class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-red-400 focus:outline-none focus:shadow-outline-red dark:focus:shadow-outline-gray"
						type="password" placeholder="Confirm Password" value="{{ old('password')}}"
						name="password_confirmation" required></input>
				</label>
				<label class="block mt-4 text-sm">
					<span class="text-gray-700 dark:text-gray-400">Role</span>
					<select
						class="block w-full text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-red-400 focus:outline-none focus:shadow-outline-red dark:focus:shadow-outline-gray"
						name="roles" required>
						<option value="SECURITY">Security</option>
						<option value="TRASHMAN">Trashman</option>
					</select>
				</label>


				<button type="submit"
					class="mt-4 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
					Add Staff
				</button>
			</div>
		</form>
	</div>
</main>
@endsection