@extends('layouts.masyarakat')

@section('title')
Dashboard
@endsection
@section('content')
<main class="h-full pb-16 overflow-y-auto">
  {{-- @foreach($liat as $li)
 <li>{{ $li->nik }}</li>
  @endforeach --}}
  <div class="container px-6 mx-auto grid">
    {{-- <h2 class="my-6 text-2xl font-semibold text-center text-gray-700 dark:text-gray-200">
      Welcome Resident {{ auth()->user()->name }}!
    </h2> --}}

    @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }} </li>
        @endforeach
      </ul>
    </div>
    @endif

  <form action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="px-4 py-3 mb-8 bg-red-300 rounded-lg shadow-xl border-2 dark:bg-gray-800">
        <label class="block text-sm">
            <h2 class="my-6 text-2xl font-semibold text-center text-gray-700 dark:text-gray-200">
                Report Form
            </h2>
            <textarea
                class="block w-full mt-1 text-sm border-2 dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-red-400 focus:outline-none focus:shadow-outline-red dark:focus:shadow-outline-gray"
                rows="8" type="text" placeholder="Fill out your report and include the location clearly"
                name="description">{{ old('description') }}</textarea>
        </label>

        <label for="image" class="block mt-4 text-sm">
            <span class="text-gray-700 dark:text-gray-400">Picture</span>
            <input
                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                type="file" name="image" accept="image/*"/>
        </label>
        @error('image')
        <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
        @enderror

        @if(session('error'))
        <div class="text-red-500 mt-1 text-sm">{{ session('error') }}</div>
        @endif

        <button
            style="width: 100%"
            type="submit"
            class="mt-4 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
            Submit
        </button>
        <button
            style="width: 100%"
            type="button"
            onclick="window.location.href='/'"
            class="mt-4 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-red">
            Back to Homepage
        </button>
    </div>
</form> 
</main>
@endsection
