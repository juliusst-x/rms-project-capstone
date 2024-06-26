@extends('layouts.admin')

@section('title')
House Data
@endsection

@section('content')
<main class="h-full pb-16 overflow-y-auto">
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200 text-center">
            Add Water Detector Form
        </h2>
        <div class="my-4 mb-6">
            <a href="{{ route('water.index')}} "
                class="px-5 py-3  font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
                Back
            </a>
        </div>

        <form action="{{ route('water.add.data') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">

                <label class="block mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Area</span>
                    <select
                        class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-red-400 focus:outline-none focus:shadow-outline-red dark:focus:shadow-outline-gray"
                        name="area_id" required>
                        <option disabled selected>Select Area Name</option>
                        @foreach($areas as $area)
                            <option value="{{ $area->id }}">{{ $area->area_name }}</option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <span class="text-red-600 dark:text-red-600">{{ $message }}</span>
                    @enderror
                </label>

                <label class="block mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Threshold</span>
                    <input
                        class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-red-400 focus:outline-none focus:shadow-outline-red dark:focus:shadow-outline-gray"
                        type="number" placeholder="Threshold" value="{{ old('Threshold')}}" name="Threshold"
                        id='Threshold'>
                </label>


                <button type="submit"
                    class="mt-4 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
                    Add Detector Data
                </button>
            </div>
        </form>
    </div>
</main>

@endsection